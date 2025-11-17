<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniForum</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

        {{-- Form posting --}}
        <form method="POST" action="{{ route('forum.store') }}" class="post-form">
            @csrf
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

        {{-- Daftar Postingan --}}
        <div class="post-list">
            @forelse($posts as $index => $post)
                <div class="post-card">
                    <div class="post-header">
                        <div class="avatar">{{ strtoupper(substr($post['nama'], 0, 1)) }}</div>
                        <div class="post-info">
                            <h3>{{ $post['nama'] }}</h3>
                            <small>{{ $post['created_at'] ?? '' }}</small>
                        </div>
                    </div>

                    <div class="post-content">{{ $post['isi'] }}</div>
                    <div class="topic-tag">{{ ucfirst($post['topik']) }}</div>

                    <button type="button" class="reply-toggle" data-index="{{ $index }}">Balas</button>

                    {{-- Form Reply --}}
                    <form method="POST" action="{{ route('forum.reply', $index) }}" class="reply-form" id="reply-form-{{ $index }}" style="display: none;">
                        @csrf
                        <input type="text" name="nama" class="input small" placeholder="Nama Anda" required>
                        <input type="text" name="balasan" class="input small" placeholder="Tulis balasan..." required>
                        <button type="submit" class="btn small">Kirim</button>
                    </form>

                    {{-- Daftar Balasan --}}
                    @if(!empty($post['replies']))
                        <div class="reply-list">
                            @foreach($post['replies'] as $reply)
                                <div class="reply-card">
                                    <strong>{{ $reply['nama'] }}</strong>: {{ $reply['balasan'] }}
                                    <small>{{ $reply['created_at'] ?? '' }}</small>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="empty">Belum ada postingan.</p>
            @endforelse
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
