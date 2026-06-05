/**
 * @file
 * Pharmacy Management module JavaScript.
 */

(function ($, Drupal) {
  'use strict';

  /**
   * Auto-calculate billing totals on form input changes.
   */
  Drupal.behaviors.pharmacyBillingCalculator = {
    attach: function (context, settings) {
      var $form = $('.billing-form', context);
      if (!$form.length) return;

      function recalculate() {
        var qty = parseFloat($('[name="quantity_sold[0][value]"]').val()) || 0;
        var price = parseFloat($('[name="unit_price[0][value]"]').val()) || 0;
        var discount = parseFloat($('[name="discount[0][value]"]').val()) || 0;
        var taxRate = parseFloat($('[name="tax_rate[0][value]"]').val()) || 0;

        var subtotal = qty * price;
        var taxAmount = subtotal * (taxRate / 100);
        var total = subtotal - discount + taxAmount;

        // Show live total preview.
        var $preview = $('#billing-total-preview');
        if (!$preview.length) {
          $preview = $('<div id="billing-total-preview" class="billing-total-preview"></div>');
          $form.find('.payment_section').after($preview);
        }
        $preview.html(
          '<div class="total-preview">' +
          '<span class="total-row"><span>Subtotal:</span><span>$' + subtotal.toFixed(2) + '</span></span>' +
          '<span class="total-row"><span>Discount:</span><span>-$' + discount.toFixed(2) + '</span></span>' +
          '<span class="total-row"><span>Tax (' + taxRate + '%):</span><span>$' + taxAmount.toFixed(2) + '</span></span>' +
          '<span class="total-row total-row--total"><span>Total:</span><span>$' + total.toFixed(2) + '</span></span>' +
          '</div>'
        );
      }

      $('[name="quantity_sold[0][value]"], [name="unit_price[0][value]"], [name="discount[0][value]"], [name="tax_rate[0][value]"]')
        .on('input change', recalculate);

      // Auto-fill unit price from selected drug.
      $('[name="drug[0][target_id]"]').on('change', function () {
        var drugName = $(this).val();
        // This is handled server-side; just trigger recalculate.
        recalculate();
      });
    }
  };

  /**
   * Highlight expiry date fields with alerts.
   */
  Drupal.behaviors.pharmacyExpiryHighlight = {
    attach: function (context, settings) {
      var $expiryInput = $('[name="expiry_date[0][value][date]"]', context);
      if (!$expiryInput.length) return;

      function checkExpiry() {
        var val = $expiryInput.val();
        if (!val) return;

        var expiryDate = new Date(val);
        var now = new Date();
        var thirtyDays = new Date();
        thirtyDays.setDate(thirtyDays.getDate() + 30);

        var $indicator = $('#expiry-indicator');
        if (!$indicator.length) {
          $indicator = $('<div id="expiry-indicator"></div>');
          $expiryInput.closest('.form-item').after($indicator);
        }

        if (expiryDate < now) {
          $indicator.html('<div class="pharmacy-alert pharmacy-alert--danger">⛔ This date has already passed — drug is EXPIRED</div>');
        } else if (expiryDate <= thirtyDays) {
          var days = Math.ceil((expiryDate - now) / 86400000);
          $indicator.html('<div class="pharmacy-alert pharmacy-alert--warning">⚠️ Expires in ' + days + ' day(s)</div>');
        } else {
          $indicator.html('');
        }
      }

      $expiryInput.on('change input', checkExpiry);
    }
  };

})(jQuery, Drupal);
