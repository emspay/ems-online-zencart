<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/includes/classes/gateways/autoload.php');
/**
 * Class for iDEAL payment method
 */
class emspay_ideal extends gingerPaymentDefault
{
    public $code = 'ideal';
    /**
     * @return string
     */
    public function javascript_validation()
    {
        return
            'if (payment_value == "'.$this->code.'") {'."\n".
            '   var issuer_id = document.checkout_payment.issuer_id.value;'."\n".
            '   if (issuer_id == "") {'."\n".
            '       error_message = error_message + "'.MODULE_PAYMENT_GINGER_IDEAL_ERROR_ISSUER.'";'."\n".
            '       error = 1;'."\n".
            '   }'."\n".
            '}'."\n";
    }

    /**
     * @return string
     */
    public function process_button()
    {
        $processButton = zen_draw_hidden_field('issuer_id', zen_output_string_protected($_POST['issuer_id']));
        $processButton .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

        return $processButton;
    }

    /**
     * Validate order before processing.
     */
    public function before_process()
    {
        parent::before_process();

        global $messageStack;

        if (empty($this->getIssuerId())) {
            $messageStack->add_session('checkout_payment', constant(MODULE_PAYMENT_.strtoupper($this->code)._ERROR_ISSUER), 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
    }
}
