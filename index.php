
<?php
$nama = "";
$email = "";
$nilai = "";
$status = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $nilai = $_POST["nilai"] ?? "";

    if ($nama == "" || $email == "" || $nilai === "") {
        $error = "Semua input wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } elseif (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
        $error = "Nilai ujian harus antara 0 sampai 100.";
    } else {
        if ($nilai > 70) {
            $status = "Lulus";
        } else {
            $status = "Remedial";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Ujian</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .hasil {
            background: #f9fafb;
            padding: 15px;
            margin-top: 15px;
            border-radius: 5px;
        }

        .status-lulus {
            color: green;
        }

        .status-remedial {
            color: red;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Form Nilai Ujian</h2>

        <form method="POST" action="">
            <label>Nama</label>
            <input
                type="text"
                name="nama"
                value="<?= htmlspecialchars($nama) ?>"
                required
            >

            <label>Email</label>
            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($email) ?>"
                required
            >

            <label>Nilai Ujian</label>
            <input
                type="number"
                name="nilai"
                min="0"
                max="100"
                step="any"
                value="<?= htmlspecialchars((string)$nilai) ?>"
                required
            >

            <button type="submit">Proses Nilai</button>
        </form>

        <?php if ($error != ""): ?>
            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <?php if ($status != ""): ?>
            <div class="hasil">
                <h3>Hasil Ujian</h3>

                <p>
                    Nama: <?= htmlspecialchars($nama) ?>
                </p>

                <p>
                    Email: <?= htmlspecialchars($email) ?>
                </p>

                <p>
                    Nilai: <?= htmlspecialchars((string)$nilai) ?>
                </p>

                <p>
                    Status:
                    <strong class="<?= $status == 'Lulus' ? 'status-lulus' : 'status-remedial' ?>">
                        <?= htmlspecialchars($status) ?>
                    </strong>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>