<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard'); ?>">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
</section>
<!-- End Page Title -->

<section class="section dashboard">
  <div class="container text-center">
    <h1>Welcome <?= ucwords(strtolower(session('fullname'))); ?></h1>
  </div>
</section>

<?= $this->endSection() ?>