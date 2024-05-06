import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { useParams } from 'react-router-dom';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getListBarangid } from '../api/BarangApi';
import 'react-toastify/dist/ReactToastify.css';
import Paginate from '../components/Pagination/paginate';
const Itemdetail = () => {
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



    
const { id } = useParams();
  useEffect(() => {
    const fetchActivity = async () => {
      const res = await getListBarangid(id);
      console.log(res.data.data);
      setData(res.data.data);
    };
    fetchActivity();
  }, [id]);
return (
        <DefaultLayout>
            <Breadcrumb pageName="Detail Barang" />
            <div>
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
                Gambar
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Catatan
              </th>
            </tr>
          </thead>
          <tbody>
            {currentItems.map((item, index) => (
              <tr key={ index}>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark ">
                    <p className="text-sm"> { index + 1}</p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <img src={`http://127.0.0.1:8000/images/${item.gambar}`} alt="Descriptive text" style={{ width: '200px', height: '100px' }} />
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark ">
                    <p className="text-sm"> {item.catatan}</p>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
  
    
                
{/* <div className='flex justify-center mt-4'> */}
{/* <Paginate currentPage={currentPage} onPageChange={handlePageChange}/></div> */}

</DefaultLayout>
    );
};

export default Itemdetail;
