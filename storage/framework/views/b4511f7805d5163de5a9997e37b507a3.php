<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniForum</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

    <!-- ====== NAVBAR ====== -->

    <nav>
        <div class="nav-center">
            <h1><span class="mini">Mini</span><span class="forum">Forum</span></h1>
            <p class="slogan">Bergabung dan diskusi dengan komunitas.</p>
        </div>
    </nav>


    <!-- ====== CONTAINER ====== -->
    <div class="container">

        
        <form method="POST" action="<?php echo e(route('forum.store')); ?>" class="post-form">
            <?php echo csrf_field(); ?>
            <input type="text" name="nama" class="input" placeholder="Nama Anda" required>
            <textarea name="isi" class="input" rows="3" placeholder="Tulis sesuatu..." required></textarea>

            <label for="topik" style="font-size:14px; color:#666;">Pilih Topik</label>
            <select name="topik" id="topik" class="input" onchange="toggleCustomTopic(this.value)">
                <option value="">-- Pilih Topik --</option>
                <option value="game">Game</option>
                <option value="musik">Musik</option>
                <option value="teknologi">Teknologi</option>
                <option value="teknologi">Kuliner</option>
                <option value="custom">+ Tambahkan Topik Baru</option>
            </select>

            <input type="text" name="topik_baru" id="topik_baru" class="input" placeholder="Masukkan topik baru..." style="display: none;">

            <button type="submit" class="btn">Posting</button>
        </form>

        
        <div class="post-list">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="post-card">
                    <div class="post-header">
                        <div class="avatar"><?php echo e(strtoupper(substr($post['nama'], 0, 1))); ?></div>
                        <div class="post-info">
                            <h3><?php echo e($post['nama']); ?></h3>
                            <small><?php echo e($post['created_at'] ?? ''); ?></small>
                        </div>
                    </div>

                    <div class="post-content"><?php echo e($post['isi']); ?></div>
                    <div class="topic-tag"><?php echo e(ucfirst($post['topik'])); ?></div>

                    <button type="button" class="reply-toggle" data-index="<?php echo e($index); ?>">Balas</button>

                    
                    <form method="POST" action="<?php echo e(route('forum.reply', $index)); ?>" class="reply-form" id="reply-form-<?php echo e($index); ?>" style="display: none;">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="nama" class="input small" placeholder="Nama Anda" required>
                        <input type="text" name="balasan" class="input small" placeholder="Tulis balasan..." required>
                        <button type="submit" class="btn small">Kirim</button>
                    </form>

                    
                    <?php if(!empty($post['replies'])): ?>
                        <div class="reply-list">
                            <?php $__currentLoopData = $post['replies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="reply-card">
                                    <strong><?php echo e($reply['nama']); ?></strong>: <?php echo e($reply['balasan']); ?>

                                    <small><?php echo e($reply['created_at'] ?? ''); ?></small>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="empty">Belum ada postingan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ====== SCRIPT ====== -->
    <script>
        // toggle form reply
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".reply-toggle").forEach(button => {
                button.addEventListener("click", function() {
                    const index = this.dataset.index;
                    const form = document.getElementById(`reply-form-${index}`);
                    form.style.display = form.style.display === "flex" ? "none" : "flex";
                });
            });
        });

        // tampilkan input topik baru
        function toggleCustomTopic(value) {
            const customInput = document.getElementById('topik_baru');
            if (value === 'custom') {
                customInput.style.display = 'block';
                customInput.required = true;
            } else {
                customInput.style.display = 'none';
                customInput.required = false;
            }
        }
    </script>

</body>
</html>
<?php /**PATH C:\Users\Yuda\miniForum\resources\views/index.blade.php ENDPATH**/ ?>