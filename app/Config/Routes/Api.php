<?php

$routes->group('api/v1', function ($routes) {

    require APPPATH . 'Config/Routes/Auth.php';

    require APPPATH . 'Config/Routes/Master.php';

    require APPPATH . 'Config/Routes/User.php';

    require APPPATH . 'Config/Routes/StudyProgram.php';
});
