<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iForum</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; color: #333; margin: 0; padding: 0; }
        header { background: #f1f1f1; padding: 10px 20px; border-bottom: 1px solid #ddd; display: flex; align-items: center; justify-content: space-between; }
        header .logo { font-weight: bold; font-size: 20px; color: #222; }
        .container { width: 80%; margin: 20px auto; }
        form { background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #333; color: #fff; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #555; }
        .post { background: #fff; padding: 15px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px; }
        .post h3 { margin: 0 0 5px; }
        .post small { color: #777; font-size: 12px; }
    </style>
</head>
<body>
    <header>
        <div class="logo">iForum</div>
        <nav>
            <a href="/" style="margin-right: 10px;">Beranda</a>
        </nav>
    </header>

    <div class="container">
        <form method="POST" action="<?php echo e(route('forum.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="judul" placeholder="Judul" required>
            <textarea name="isi" rows="4" placeholder="Tulis isi postingan..." required></textarea>
            <input type="text" name="topik" placeholder="Topik (opsional)">
            <button type="submit">Kirim</button>
        </form>

        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="post">
                <h3><?php echo e($post['judul'] ?? '(Tanpa Judul)'); ?></h3>
                <p><?php echo e($post['isi'] ?? '(Tidak ada isi)'); ?></p>
                <small>Topik: <?php echo e($post['topik'] ?? 'umum'); ?> | <?php echo e($post['created_at'] ?? ''); ?></small>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</body>
</html>
<?php /**PATH C:\Users\Yuda\miniForum\resources\views/forum.blade.php ENDPATH**/ ?>