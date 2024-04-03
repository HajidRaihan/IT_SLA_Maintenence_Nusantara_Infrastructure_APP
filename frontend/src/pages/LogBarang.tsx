import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getBarang } from '../api/BarangApi';
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
        getBarang()
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
            <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                <div className='flex items-center'>
                <h4 className="mb-6 text-xl font-semibold text-black dark:text-white">
                    Log Barang
                </h4>
        </div>
                <div className="flex flex-col">
                    <div className="grid grid-cols-7 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-7">
                        <div className="p-2.5 xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">No</h5>
                        </div>
                        <div className="pt-2.5 pr-2.5 pb-2.5 pl-0 xl:pl-0">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Nama Equipment</h5>
                        </div> 
                        <div className="pt-2.5 pr-2.5 pb-2.5 pl-0 xl:pl-0">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Tanggal Update</h5>
                        </div><div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Company</h5>
                        </div>

                        <div className="p-2.5 text-center xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Unit</h5>
                        </div>
                        <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Merk</h5>
                        </div>
                        <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Action</h5>
                        </div>
                    
                    </div>

                    {currentItems.map((item, index) => (
                    <div className="grid grid-cols-7 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-7" key={startIndex + index}>
                    <div className="p-2.5 xl:p-5">
                        <p>{startIndex + index + 1}</p>
                    </div>
                    <div className="p-2.5  xl:p-3">
                        <p>{item.nama_equipment}</p>
                    </div>
                    <div className="p-2.5  xl:p-3">
                    <p>{moment(item.updated_at).tz("Asia/Makassar").format("DD-MM-YYYY ")}</p>
                    </div>
                    <div className="p-2.5 text-center xl:p-5">
                        <p>{item.perusahaan}</p>
                    </div>
                    <div className="p-2.5 text-center xl:p-5">
                        <p>{item.unit}</p>
                    </div>
                    <div className="p-2.5 text-center xl:p-5">
                        <p>{item.merk}</p>
                    </div>
                    <div className="mb-3 justify-center flex items-center">
         <button style={{ 
        backgroundColor: item.adddata_string === 'masuk' ? 'green' : 'red',
        color: 'white', 
        border: 'none', 
        padding: '8px 16px', 
        borderRadius: '4px' 
    }}>
        {item.adddata_string}
    </button>
</div>


                </div>
                    ))}
                </div>
            </div>
                
<div className='flex justify-center mt-4'>
<Paginate currentPage={currentPage} onPageChange={handlePageChange}/></div>

</DefaultLayout>
    );
};

export default LogBarang;
