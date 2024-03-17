<!-- report -->
@extends('app.main')
@section('title', 'Report Data Device')
@section('content')
<!-- Dashboard content goes here -->
<div class="page-heading">
    <h3>Report Data Device</h3>
    <p class="text-subtitle text-muted">Sorts & Export data based on selected sites and device ID</p>
    <div style="display: flex; align-items: center;">
        <select class="form-select me-2" id="site_select" style="max-width: 200px;">
            <option selected disabled>Select Sites</option>
            @foreach($sites as $site)
            <option value="{{ $site->id_sites }}">{{ $site->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Device</th>
                            <th class="text-center">Voltage</th>
                            <th class="text-center">Current</th>
                            <th class="text-center">Power</th>
                            <th class="text-center">Temperature</th>
                            <th class="text-center">Last Update</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody id="table_body">
                       
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tableBody = document.getElementById("table_body");

    // Fungsi untuk mengubah format tanggal
    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { 
            year: 'numeric', 
            month: 'short', 
            day: '2-digit', 
            hour: '2-digit', 
            minute: '2-digit' 
        };
        return date.toLocaleDateString('id-ID', options).replace(',', '');
    }

    // Fungsi untuk menampilkan data pada tabel
    function showTableData(site_id) {
        fetch('/report/' + site_id)
            .then(response => response.json())
            .then(data => {
                // Replace the table data
                var tableBody = document.getElementById('table_body');
                tableBody.innerHTML = '';  // Clear the table body

                if (data.length === 0) {
                    // Jika tidak ada data device pada site yang dipilih, tambahkan pesan peringatan
                    var noDataWarning = document.createElement('tr');
                    noDataWarning.innerHTML = `
                        <td colspan="8" class="text-center">No devices found for this site</td>
                    `;
                    tableBody.appendChild(noDataWarning);
                } else {
                    data.forEach(function(device, index) {
                        console.log('DEVICE ID: ' + device.id_device);
                        fetch(`/devices/${device.id_device}/source-data`)
                            .then(response2 => response2.json())
                            .then(source => {
                                console.log(source);
                                var row = document.createElement('tr');
                                console.log(device);

                                // Add cells to the row
                                row.innerHTML = `
                                    <td class="text-center">${index + 1}</td>
                                    <td class="text-center">${device.device_name}</td>
                                    <td class="text-center">${source ? source[0].voltage : 'N/A'} V</td>
                                    <td class="text-center">${source ? source[0].current : 'N/A'} A</td>
                                    <td class="text-center">${source ? source[0].power : 'N/A'} W</td>
                                    <td class="text-center">${source ? source[0].temperature : 'N/A'} C</td>
                                    <td class="text-center">${formatDate(device.updated_at)}</td>
                                    <td class="text-center">${device.status === 1 ? '<span class="badge bg-success">ON</span>' : '<span class="badge bg-danger">OFF</span>'}</td>
                                `;
        
                                // Add the row to the table body
                                tableBody.appendChild(row);
                            });
                    });
                }
            });
    }


    // Memanggil fungsi untuk menampilkan data pada tabel saat halaman dimuat pertama kali
    var site_id = document.getElementById('site_select').value;
    showTableData(site_id);

    // Event listener untuk saat pilihan situs diubah
    document.getElementById('site_select').addEventListener('change', function() {
        var site_id = this.value;
        console.log(site_id);  // Outputs the selected site_id to the console
        tableBody.innerHTML = "";
        showTableData(site_id);
    });

    // Event listener untuk saat pilihan jumlah data diubah
    document.getElementsByClassName('dataTable-selector')[0].addEventListener('change', function() {
        var dataToShow = this.value;
        console.log(dataToShow);
        var site_id = document.getElementById('site_select').value;

        tableBody.innerHTML = "";
        fetch('/report/' + site_id)
            .then(response => response.json())
            .then(data => {
                data = data.slice(0, dataToShow);

                // Replace the table data
                var tableBody = document.getElementById('table_body');
                tableBody.innerHTML = '';  // Clear the table body
                
                data.forEach(function(device, index) {
                    console.log('DEVICE ID: ' + device.id_device);
                    fetch(`/devices/${device.id_device}/source-data`)
                        .then(response2 => response2.json())
                        .then(source => {
                            console.log(source);
                            var row = document.createElement('tr');
                            console.log(device);
                            // Add cells to the row
                            row.innerHTML = `
                                <td class="text-center">${index + 1}</td>
                                <td class="text-center">${device.device_name}</td>
                                <td class="text-center">${source ? source[0].voltage : 'N/A'} V</td>
                                <td class="text-center">${source ? source[0].current : 'N/A'} A</td>
                                <td class="text-center">${source ? source[0].power : 'N/A'} W</td>
                                <td class="text-center">${source ? source[0].temperature : 'N/A'} C</td>
                                <td class="text-center">${formatDate(device.updated_at)}</td>
                                <td class="text-center">${device.status === 1 ? '<span class="badge bg-success">ON</span>' : '<span class="badge bg-danger">OFF</span>'}</td>
                            `;
    
                            // Add the row to the table body
                            tableBody.appendChild(row);
                        })

                });
            });
    });
    document.getElementsByClassName("dataTable-pagination")[0].innerHTML = "";
});

</script>