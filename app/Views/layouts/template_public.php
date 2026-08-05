<?= $this->include('layouts/header') ?>

<body>

<?= $this->include('layouts/navbar') ?>

<?= $this->renderSection('content') ?>

<?= $this->include('layouts/footer') ?>

<script>

const scrollBtn = document.getElementById("scrollTopBtn");

window.onscroll = function () {

    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {

        scrollBtn.style.display = "block";

    } else {

        scrollBtn.style.display = "none";

    }

};

scrollBtn.onclick = function () {

    window.scrollTo({

        top:0,

        behavior:'smooth'

    });

};

</script>