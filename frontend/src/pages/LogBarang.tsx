import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getlogBarang } from '../api/BarangApi';
import 'react-toastify/dist/ReactToastify.css';
import Paginate from '../components/Pagination/paginate';
import moment from 'moment-timezone';
const LogBarang = () => {
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

    
      useEffect(() => {
        getlogBarang()
            .then(res => {
                setData(res);
            })
            .catch(error => {
                console.error('Error fetching barang data:', error);
            });
    }, []);



    
    return (
        <DefaultLayout>
            <Breadcrumb pageName="Barang" />
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
        backgroundColor: item.adddata_string === 'masuk' ? 'green' : 'red',
        color: 'black', 
        border: 'none', 
        padding: '8px 16px', 
        borderRadius: '4px' 
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

export default LogBarang;
