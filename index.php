<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUYYYYY KENAPAAA???</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffe4e1;
        }
        .wadah {
            background: #ffcccb;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(255, 105, 180, 0.5);
            text-align: center;
            max-width: 400px;
            animation: muncul 0.5s ease-in-out;
        }
        @keyframes muncul {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .pertanyaan {
            font-size: 20px;
            margin-bottom: 20px;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
            color: #d63384;
        }
        .emoji {
            font-size: 30px;
            display: block;
            margin-bottom: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .kotak-input {
            display: none;
        }
        .kotak-input input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 2px solid #d63384;
            font-size: 16px;
        }
        .tombol-lanjut {
            margin-top: 10px;
            padding: 10px 15px;
            border: none;
            background: #d63384;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .tombol-lanjut:hover {
            background: #b22269;
        }
    </style>
</head>
<body>
    <div class="wadah">
        <span id="emoji" class="emoji">🤔</span>
        <p id="pertanyaan" class="pertanyaan">Kamu kenapa buyy?</p>
        <div class="kotak-input">
            <input type="text" id="jawaban" placeholder="Tulis di sini...">
            <button class="tombol-lanjut" onclick="kirimJawaban()">Kirim</button>
        </div>
        <button class="tombol-lanjut" onclick="lanjutPertanyaan()">Lanjut</button>
    </div>

    <script>
        const pertanyaanList = [
            "Kamu kenapaa buyyy?",
            "Kok sekarang kaya beda gitu?",
            "Benci sama aku yaa?",
            "Kok kamu jadi berubah gini si, aku jadi canggung deketin kamu lagi nya?",
            "Kalo kamu punya dendam pribadi atau masalah perasaan ke aku kamu boleh cerita di sini yaa, biar aku tau salah aku dimana."
        ];
        const emojiList = ["🤔", "😳", "😢", "🥺", "💔"];
        let indexSaatIni = 0;
        const teksPertanyaan = document.getElementById("pertanyaan");
        const teksEmoji = document.getElementById("emoji");
        const kotakInput = document.querySelector(".kotak-input");
        const inputJawaban = document.getElementById("jawaban");

        function lanjutPertanyaan() {
            if (indexSaatIni < pertanyaanList.length - 1) {
                indexSaatIni++;
                teksPertanyaan.style.opacity = "0";
                teksEmoji.style.transform = "scale(1.2)";
                setTimeout(() => {
                    teksPertanyaan.innerText = pertanyaanList[indexSaatIni];
                    teksEmoji.innerText = emojiList[indexSaatIni];
                    teksPertanyaan.style.opacity = "1";
                    teksEmoji.style.transform = "scale(1)";
                    if (indexSaatIni === pertanyaanList.length - 1) {
                        kotakInput.style.display = "block";
                    }
                }, 500);
            }
        }

        function kirimJawaban() {
            const jawaban = inputJawaban.value;
            if (jawaban.trim() === "") {
                alert("Isi dulu dong!");
                return;
            }
            
            fetch('simpan_jawaban.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'jawaban=' + encodeURIComponent(jawaban)
            })
            .then(response => response.text())
            .then(data => {
                alert("Jawaban sudah disimpan!");
                inputJawaban.value = "";
            })
            .catch(error => console.error('Terjadi kesalahan:', error));
        }
    </script>
</body>
</html>
