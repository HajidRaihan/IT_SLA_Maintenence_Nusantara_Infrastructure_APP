import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { useParams } from 'react-router-dom';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getBarangid } from '../api/BarangApi';
import 'react-toastify/dist/ReactToastify.css';
import Paginate from '../components/Pagination/paginate';
import moment from 'moment-timezone';
import { useNavigate } from 'react-router-dom';
const HistoryBarang = () => {
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

const navigate = useNavigate();

    
const { id } = useParams();
  useEffect(() => {
    const fetchActivity = async () => {
      const res = await getBarangid(id);
      console.log(res.data.data);
      setData(res.data.data);
    };
    fetchActivity();
  }, [id]);
return (
        <DefaultLayout>
            <Breadcrumb pageName="Barang" />
            <div>
      <button style={{  // Using material colors for better visual
    color: 'white', // Better contrast for readability
    border: 'none',
    padding: '10px 20px', // Increased padding for a better touch area
    borderRadius: '5px', // Slightly more rounded corners
    cursor: 'pointer', // Cursor pointer to indicate it's clickable
    outline: 'none', // Removes outline but ensure to manage :focus for accessibility
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)', // Subtle shadow to lift the button off the page
    transition: 'all 0.3s ease' // Smooth transition for hover and active states
}} onClick={() => navigate('/logallbarang')}>View Logs by Week/Month/Year</button>
      {/* Existing table and pagination logic */}
    </div>
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
  
    
                
<div className='flex justify-center mt-4'>
<Paginate currentPage={currentPage} onPageChange={handlePageChange}/></div>

</DefaultLayout>
    );
};

export default HistoryBarang;
