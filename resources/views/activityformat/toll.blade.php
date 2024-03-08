
<div class="container">
        <h2>Add Data Log Activity Toll</h2>
        <form action="{{ url('/apiaddactivity_toll') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tampilkan pesan kesalahan validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tampilkan pesan berhasil --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form input --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="user_id">User ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="user_id" name="user_id"
                       />
                </div>
            </div>

            {{-- Tambahkan input fields sesuai kebutuhan Anda --}}
            
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="status">Status</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span id="status-icon" class="input-group-text"><i class="bx bx-info-circle"></i></span>
                        <select class="form-select" id="status" name="status" onchange="updateStatusButton(this)" required>
                            <option value="pending">Pending</option>
                            <option value="on process">On Process</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Upload foto --}}
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="foto">Foto</label>
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span id="foto-icon" class="input-group-text"><i class="bx bx-camera"></i></span>
                        <input type="file" class="form-control" id="foto" name="foto" required />
                    </div>
                </div>
            </div>

            {{-- Tombol submit --}}
            <div class="row mb-3">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="simpan">Save Data</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateStatusButton(selectElement) {
            var selectedValue = selectElement.value;
            var statusIcon = document.getElementById('status-icon');
            var statusButton = statusIcon.closest('.input-group-merge').nextElementSibling; // Assuming the button is the next sibling

            if (statusButton) {
                // Remove existing classes
                statusButton.classList.remove('btn-warning', 'btn-info', 'btn-success');

                // Add new class based on the selected value
                if (selectedValue === 'pending') {
                    statusButton.classList.add('btn-warning');
                } else if (selectedValue === 'on process') {
                    statusButton.classList.add('btn-info');
                } else if (selectedValue === 'completed') {
                    statusButton.classList.add('btn-success');
                }
            }
        }
    </script>
