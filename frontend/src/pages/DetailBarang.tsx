import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { useParams } from 'react-router-dom';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getListBarangid } from '../api/BarangApi';
import 'react-toastify/dist/ReactToastify.css';
import Paginate from '../components/Pagination/paginate';
const Itemdetail = () => {
    const [data, setData] = useState([]);
const { id } = useParams();
  useEffect(() => {
    const fetchActivity = async () => {
      const res = await getListBarangid(id);
      console.log(res.data);
      setData(res.data);
    };
    fetchActivity();
  }, [id]);
return (
        <DefaultLayout>
            <Breadcrumb pageName="Detail Barang" />
            {data.map((item) => (
             <div className="max-w-4xl mx-auto p-5">
               <h3 className="text-xl font-bold mb-2">Item Details</h3>
             <div className="bg-white shadow-md rounded-lg overflow-hidden">
                 <img src={`http://127.0.0.1:8000/images/${item.gambar}`} style={{ width: '100%', height: '100%' }} alt={item.catatan} className="w-full h-64 object-cover"/>
                 <div className="p-4">
                    
                     <p className="text-gray-700 mb-4">Catatan: {item.catatan}</p>
                     {/* You can add more details here */}
                 </div>
             </div>
         </div>
            ))}
  
</DefaultLayout>
    );
};

export default Itemdetail;