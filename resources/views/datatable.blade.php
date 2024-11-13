
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <style>
        /* Menata form input */
        #inputForm {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            max-width: 600px;
            margin: 0 auto;
        }

        #inputForm label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        #inputForm input, #inputForm select, #inputForm button {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #inputForm button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #inputForm button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <h1>Halo data table!</h1>
    <!-- Form untuk input data baru -->
    <form id="inputForm">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Umur:</label>
        <input type="number" id="age" name="age" required>

        <label for="gender">Jenis Kelamin:</label>
        <select id="gender" name="gender" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

        <button type="submit">Tambah Data</button>
    </form>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Andi</td>
                <td>25</td>
                <td>Laki-laki</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Agus</td>
                <td>25</td>
                <td>Laki-laki</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Anis</td>
                <td>25</td>
                <td>Perempuan</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Indah</td>
                <td>25</td>
                <td>Perempuan</td>
            </tr>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columnDefs: [
                { width: "5%", targets: 0 }
            ]
        });

        // Menambah data baru ketika form disubmit
        $('#inputForm').on('submit', function(event) {
            event.preventDefault();

            // Ambil data dari form
            var name = $('#name').val();
            var age = $('#age').val();
            var gender = $('#gender').val();

            // Tambahkan data ke tabel
            var rowCount = table.rows().count() + 1;
            table.row.add([rowCount + '.', name, age, gender]).draw(false);

            // Reset form setelah submit
            $('#inputForm')[0].reset();
        });
    });
    </script>
</body>
</html>

