import React from 'react';
import html2pdf from 'html2pdf.js';
import Logo from '../../assets/logo/logo1.jpg';
// import './Pdf.css';

const PdfModal = () => {
  const data = {
    id: 2,
    nama_user: 'raa',
    waktu_pengerjaan: null,
    kategori_activity: 'toll',
    company: 'mmn',
    jenis_hardware: 'LLA/OTL, CCTV',
    standart_aplikasi: 'Microsoft, Power Point',
    uraian_hardware: 'Ex ea voluptatem fug',
    uraian_aplikasi: 'Cupidatat minim dele',
    aplikasi_it_tol: 'Program CCTV/VMS',
    uraian_it_tol: 'Eos eum sit sint co',
    catatan: 'Atque ratione at sap',
    shift: '51',
    kondisi_akhir: null,
    biaya: null,
    foto_awal: '1716260865_awal.jpg',
    foto_akhir: 'png',
    status: 'process',
    ended_at: null,
    created_at: '2024-05-21T03:07:45.000000Z',
    updated_at: '2024-05-21T03:07:45.000000Z',
    category_deadline: 6,
    category_name: 'kerusakan mayor',
    location_name: 'kantor cambayya',
  };

  const generatePDF = () => {
    const element = document.getElementById('pdf-content');
    html2pdf().from(element).save();
  };

  return (
    <div className="PdfModal m-5">
      <div id="pdf-content" className="form-content p-5 border border-black">
        <table className="w-full mb-5">
          <tr>
            <td className="border w-1/3 p-2">
              <div className="flex items-center justify-center">
                <div>
                  <img src={Logo} alt="Logo" className="w-32 mb-2" />
                </div>
              </div>
            </td>
            <td className="border w-1/3 p-2">
              <div className="flex items-center justify-center h-full">
                <h1 className="text-center font-bold">
                  Form Maintenance & Permintaan Perbaikan
                </h1>
              </div>
            </td>
            <td className="border w-1/3 text-xs">
              <table className="w-full border-collapse">
                <tr>
                  <td className="border-r p-2">No Dok :</td>
                  <td className=" p-2">FO-MMN-MIS-02-03</td>
                </tr>
                <tr>
                  <td className="border-r border-t p-2">Tgl Terbit :</td>
                  <td className="border-t p-2">--/--/----</td>
                </tr>
                <tr>
                  <td className="border-r border-t p-2">No. Rev :</td>
                  <td className="border-t p-2">05</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        <div className="p-4 border mb-5">
          <div className="mb-4">
            <span className="font-bold">Hardware:</span>
            <input type="checkbox" className="ml-2" /> Tol
            <input type="checkbox" className="ml-2" /> Non Tol
          </div>
          <table className="w-full border-collapse mb-4">
            <thead>
              <tr className="bg-gray-200">
                <th className="border p-2 w-1/3">Jenis Hardware</th>
                <th className="border p-2 w-1/6">Kondisi</th>
                <th className="border p-2 w-1/2 text-red-500">
                  Mohon dijabarkan Permasalahan**
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> PC/Laptop
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Server
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Printer/Periferal
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Printer/Periferal
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Printer/Periferal
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Lainnya
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div className="p-4 border">
          <div className="mb-4">
            <span className="font-bold">Software:</span>
            <input type="checkbox" className="ml-2" /> Tol
            <input type="checkbox" className="ml-2" /> Non Tol
          </div>
          <table className="w-full border-collapse mb-4">
            <thead>
              <tr className="bg-gray-200">
                <th className="border p-2 w-1/3">Standard Aplikasi</th>
                <th className="border p-2 w-1/6">Kondisi</th>
                <th className="border p-2 w-1/2 text-red-500">
                  Mohon dijabarkan Permasalahan**
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Operating System
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Open
                  Office/word/excel/powerpoint
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Lainnya
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
            </tbody>
          </table>
          <table className="w-full border-collapse">
            <thead>
              <tr className="bg-gray-200">
                <th className="border p-2 w-1/3">
                  Aplikasi IT & Peralatan Tol
                </th>
                <th className="border p-2 w-1/6">Kondisi</th>
                <th className="border p-2 w-1/2 text-red-500">
                  Mohon dijabarkan Permasalahan**
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Program LTCS/TFI
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Program PCS
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Program RTM
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Program CCTV/VMS
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
              <tr>
                <td className="border p-2">
                  <input type="checkbox" className="mr-2" /> Lainnya
                </td>
                <td className="border p-2"></td>
                <td className="border p-2"></td>
              </tr>
            </tbody>
          </table>
        </div>
        {/* <p>
          <strong>No Dok:</strong> FO-MMN-MIS-02-03
        </p>
        <p>
          <strong>Tgl Terbit:</strong>
        </p>
        <p>
          <strong>No. Rev:</strong> 05
        </p>
        <p>
          <strong>Periode (Diisi oleh user):</strong> I II III III …….
        </p>

        <p>
          <strong>Nama Lengkap (user):</strong> {data.nama_user}
        </p>
        <p>
          <strong>Lokasi:</strong> {data.location_name} <strong>Tgl:</strong>{' '}
          {new Date(data.created_at).toLocaleDateString()}
        </p>
        <p>
          <strong>Departemen/Shift:</strong> {data.company}/{data.shift}
        </p>
        <p>
          <strong>Jabatan:</strong>
        </p>

        <h2>Hardware:</h2>
        <p>
          <strong>Tol/Non Tol:</strong> {data.kategori_activity}
        </p>
        <p>
          <strong>Jenis Hardware:</strong> {data.jenis_hardware}
        </p>
        <p>
          <strong>Kondisi:</strong>
        </p>
        <p>
          <strong>Mohon dijabarkan Permasalahan:</strong> {data.uraian_hardware}
        </p>

        <h2>Software:</h2>
        <p>
          <strong>Tol/Non Tol:</strong> {data.kategori_activity}
        </p>
        <p>
          <strong>Standard Aplikasi:</strong> {data.standart_aplikasi}
        </p>
        <p>
          <strong>Kondisi:</strong>
        </p>
        <p>
          <strong>Mohon dijabarkan Permasalahan:</strong> {data.uraian_aplikasi}
        </p>

        <h2>Aplikasi IT & Peralatan Tol:</h2>
        <p>
          <strong>Kondisi:</strong>
        </p>
        <p>
          <strong>Mohon dijabarkan Permasalahan:</strong> {data.uraian_it_tol}
        </p>

        <h2>Catatan:</h2>
        <p>{data.catatan}</p>

        <h2>Mengetahui (Atasan IT):</h2>
        <p>Nama:</p>

        <h2>Pengecekan Oleh (IT):</h2>
        <p>Nama:</p>

        <h2>User (Teknisi IT):</h2>
        <p>Nama:</p> */}
      </div>
      <button onClick={generatePDF}>Generate PDF</button>
    </div>
  );
};

export default PdfModal;
