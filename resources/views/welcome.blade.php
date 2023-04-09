<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Timetable application</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div id="schedule"></div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="/js/off-canvas.js"></script>
<script src="/js/hoverable-collapse.js"></script>
<script src="/js/template.js"></script>
<script src="/js/settings.js"></script>
<script src="/js/todolist.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=WeakRef,BigInt"></script>
<script src="https://cdn.jsdelivr.net/npm/superagent"></script>
<script type="text/javascript">
    (function () {
        superagent
            .post('/api/refresh')
            .set('Authorization', `Bearer ${localStorage.getItem('token')}`)
            .set('accept', 'json')
            .then((res) => {
                res = res.body;
                localStorage.setItem('user', res.user);
                localStorage.setItem('token', res.authorisation.token);
            }).catch((err) => {
                window.location.href = '/';
        });
    })();
</script>
<script src="
https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.5/index.global.min.js
"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('schedule');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'resourceTimelineWeek'
        });
        calendar.render();
    });
</script>
<!-- endinject -->
</body>

</html>
