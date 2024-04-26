import React, { useState,useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { jsPDF } from 'jspdf';
import { parse } from 'papaparse';
import { getlogBarang } from '../api/BarangApi';
import autoTable from 'jspdf-autotable';

import moment from 'moment-timezone';
const YourNewComponent = () => {
  const navigate = useNavigate();
  const [period, setPeriod] = useState('week'); // Default filter
  const [data, setData] = useState([]);

  const [currentPage, setCurrentPage] = useState(1); // Current page state
    const itemsPerPage = 5; // Number of data items per page

// Calculate total number of pages
    const startIndex = (currentPage-1) * itemsPerPage ;
    const endIndex = Math.min(startIndex + itemsPerPage, data.length);

// Filter the data to display only the items for the current page
const currentItems = data.slice(startIndex, endIndex);



const handlePageChange = (page) => {
setCurrentPage(page); // Update the current page
};

const handleExportPDF = () => {
  const doc = new jsPDF();

  // Load your image
  //  const logoImg = '../../assets/logo/logo.png'; // Ensure this is pre-loaded if asynchronous

  // // // Add the image and title
  // doc.addImage(logoImg, 'PNG', 15, 10, 50, 50);
  doc.setFontSize(22);
  doc.text('List Barang', 105, 30, null, null,);

  // Define the columns
  const columns = [
      { header: 'NO', dataKey: 'no' },
      { header: 'NAMA EQUIPMENT', dataKey: 'nama_equipment' },
      { header: 'UNIT', dataKey: 'unit' },
      { header: 'MERK', dataKey: 'merk' },
      { header: 'STOCK', dataKey: 'stock' },
  ];

  // Generate rows
  const rows = data.map((item, index) => ({
      no: index + 1,
      nama_equipment: item.nama_equipment,
      unit: item.unit,
      merk: item.merk,
      stock: item.stock,
  }));

  // Calculate the height of each row
  const rowHeight = 10; // Adjust as needed based on font size and styling

  // Calculate the total height of the table
  const tableHeight = rows.length * rowHeight;

  // Draw the table
  const startY = 70;
  autoTable(doc, {
      startY: startY,
      columns: columns,
      body: rows,
      theme: 'grid',
      styles: { fontSize: 10, cellPadding: 2, overflow: 'linebreak' },
      columnStyles: {
          no: { cellWidth: 15 },
          nama_equipment: { cellWidth: 60 },
          unit: { cellWidth: 30 },
          merk: { cellWidth: 30 },
          stock: { cellWidth: 30 },
      },
      headStyles: { fillColor: [128, 128, 128] } // Gray background in the header
  });

  // Calculate the final Y position
  const finalY = startY + tableHeight;

  // Additional text and potentially an image for a signature
  doc.text('Makassar, ', 15, finalY + 20);
  doc.text('Dicheck Oleh:', 15, finalY + 30);
  // doc.addImage(signatureImg, 'PNG', 15, finalY + 35, 40, 15);
  doc.text('( IT & Development )', 15, finalY + 60);

  // Save the PDF
  doc.save('list_barang.pdf');
};

  useEffect(() => {
    getlogBarang()
        .then(res => {
            setData(res);
        })
        .catch(error => {
            console.error('Error fetching barang data:', error);
        });
}, []);


  const handleExportCSV = () => {
    const csv = parse(data, { header: true });
    const csvData = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const csvURL = window.URL.createObjectURL(csvData);
    const tempLink = document.createElement('a');
    tempLink.href = csvURL;
    tempLink.setAttribute('download', 'logbarang.csv');
    tempLink.click();
  };

  return (
    <div>
      <button onClick={() => navigate('/')}>Back to Log Barang</button>
      <select value={period} onChange={e => setPeriod(e.target.value)}>
        <option value="week">Week</option>
        <option value="month">Month</option>
        <option value="year">Year</option>
      </select>
      <div className="max-w-full overflow-x-auto">
        <table className="w-full table-auto">
          <thead>
            <tr className="bg-gray-2 text-left dark:bg-meta-4">
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                NO
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Nama Equipment
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Tanggal Activity
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Company
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Stock Value
              </th>

              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Action Value
              </th>
            </tr>
          </thead>
          <tbody>
            {currentItems.map((item, index) => (
              <tr key={startIndex + index}>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark ">
                    <p className="text-sm"> {startIndex + index + 1}</p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p className="text-black dark:text-white">
                    {item.nama_equipment}
                  </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <p>{moment(item.created_at).tz("Asia/Makassar").format("DD-MM-YYYY ")}</p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p className="text-black dark:text-white">
                    {item.perusahaan}
                  </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <p className="text-black dark:text-white">
                 {item.adddata !== null ? item.addata : item.mindata}
                </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <button style={{ 
    backgroundColor: item.adddata_string === 'masuk' ? '#4CAF50' : '#F44336', // Using material colors for better visual
    color: 'white', // Better contrast for readability
    border: 'none',
    padding: '10px 20px', // Increased padding for a better touch area
    borderRadius: '5px', // Slightly more rounded corners
    cursor: 'pointer', // Cursor pointer to indicate it's clickable
    outline: 'none', // Removes outline but ensure to manage :focus for accessibility
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)', // Subtle shadow to lift the button off the page
    transition: 'all 0.3s ease' // Smooth transition for hover and active states
}}
onFocus={e => {
    e.target.style.borderColor = 'rgba(255, 255, 255, 0.5)'; // Adding a focus style for accessibility
      e.target.style.outline = 'none'; // Ensures outline doesn't appear
}}
onBlur={e => {
    e.target.style.borderColor = 'transparent'; // Resets border when not focused
}}>
    {item.adddata_string}
</button>

             
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
  
      <button onClick={handleExportPDF}>Export as PDF</button>
      <button onClick={handleExportCSV}>Export as CSV</button>
    </div>

    
  );
};

export default YourNewComponent;
