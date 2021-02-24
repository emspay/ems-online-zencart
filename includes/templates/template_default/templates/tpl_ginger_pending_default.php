<?php if ($_GET['failed']): ?>
    <h3>
        <?php echo GINGER_ORDER_PENDING; ?>
    </h3>
    <p>
        <?php echo GINGER_ORDER_PENDING_MESSAGE; ?>
    </p>
<?php else: ?>
    <h3>
        <?php echo GINGER_ORDER_PROCESSING; ?>
    </h3>
    <p>
        <?php echo GINGER_PLEASE_WAIT; ?>
    </p>
    <div>
        <img src="<?php echo DIR_WS_IMAGES ?>/ginger/ajax-loader.gif"/>
    </div>

    <script language="JavaScript">
        var fallback_url = '<?php echo htmlspecialchars_decode(zen_href_link(FILENAME_GINGER_PENDING, '&failed=1', 'SSL')); ?>';
        var validation_url = '<?php echo htmlspecialchars_decode(zen_href_link(FILENAME_CHECKOUT_PROCESS, '&order_id='.$_GET['order_id'], 'SSL')); ?>';

        $(document).ready(function () {
            var counter = 0;
            var loop = setInterval(
                function refresh_pending() {
                    counter++;
                    $.ajax({
                        type: "POST",
                        url: $(location).attr('href'),
                        data: {processing: '1'},
                        dataType: 'json',
                        success: function (data) {
                            if (data.redirect == true) {
                                location.href = validation_url;
                            }
                        }
                    });
                    if (counter >= 6) {
                        clearInterval(loop);
                        location.href = fallback_url;
                    }
                },
                10000
            );
        });
    </script>
<?php endif; ?>
