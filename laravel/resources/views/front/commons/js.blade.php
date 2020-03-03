<script>
//
//    function unseenMessages() {
//
//        $.ajax({
//            url: "<?php //echo url("");                                 ?>/messages/unseen",
//            type: 'get',
//            dataType: 'html',
//            success: function (result) {
//
//                $('.unseen_messages').html(result);
//            }
//        });
//    }
//
function unseenNotifications() {

 $.ajax({
    url: "<?php echo url("");?>/notifications/unseen",
    type: 'get',
    dataType: 'html',
    success: function (result) {
        $('.unseen_notifications').html(result);
    }
});
}
$('.noti-btn').on('click',function(){
    window.location.href ="<?php echo url('notifications'); ?>";
});
//    setInterval(checkCron, 1000);
//    function checkCron() {
//        $.get(<?php // echo url('run/post/cron');         ?>, function (data) {
//            console.log(data);
//        });
//}
</script>
