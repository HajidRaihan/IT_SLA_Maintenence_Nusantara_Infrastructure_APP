import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getlogBarang } from '../api/BarangApi';
import 'react-toastify/dist/ReactToastify.css';
import moment from 'moment-timezone';
import { useNavigate } from 'react-router-dom';

const LogBarang = () => {
  const [data, setData] = useState([]);
  const [filteredRecords, setFilteredRecords] = useState([]);
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const navigate = useNavigate();

  // Load all data initially
  useEffect(() => {
    getlogBarang()
      .then(res => {
        setData(res);
        setFilteredRecords(res); // Initially, filtered records are all records
      })
      .catch(error => {
        console.error('Error fetching barang data:', error);
      });
  }, []);

  // Function to handle date filtering
  const handleFilter = () => {
    if (startDate && endDate) {
      const start = new Date(startDate);
      const end = new Date(endDate);
      const filtered = data.filter(item => {
        const itemDate = new Date(moment(item.created_at).format('YYYY-MM-DD'));
        return itemDate >= start && itemDate <= end;
      });
      setFilteredRecords(filtered);
    } else {
      setFilteredRecords(data); // No filter applied, show all records
    }
  };

  // When dates are set, trigger filtering
  useEffect(() => {
    handleFilter();
  }, [startDate, endDate]);


  return (
    <DefaultLayout>
      <Breadcrumb pageName="Log Barang" />
      <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif' }}>
            <div style={{
                marginBottom: '10px',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'flex-start'
            }}>
                <label style={{
                    marginRight: '10px',
                    fontWeight: 'bold',
                    fontSize: '16px',
                    color: '#333'
                }}><p className="text-black dark:text-white">Start Date:</p></label>
                <input
                    type="date"
                    value={startDate}
                    onChange={e => setStartDate(e.target.value)}
                    style={{
                        padding: '8px',
                        border: '2px solid #ccc',
                        borderRadius: '4px',
                        fontSize: '16px'
                    }}
                />
            </div>
            <div style={{
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'flex-start'
            }}>
                <label style={{
                    marginRight: '10px',
                    fontWeight: 'bold',
                    fontSize: '16px',
                    color: '#333'
                }}><p className="text-black dark:text-white">End Date:</p></label>
                <input
                    type="date"
                    value={endDate}
                    onChange={e => setEndDate(e.target.value)}
                    style={{
                        padding: '8px',
                        border: '2px solid #ccc',
                        borderRadius: '4px',
                        fontSize: '16px'
                    }}
                />
            </div>
        </div>
      <div className="max-w-full overflow-x-auto">
        {filteredRecords.length > 0 ? (
          <table className="w-full table-auto">
            <thead>
               <tr className="bg-gray-2 text-left dark:bg-meta-4">
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   NO
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Status
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Nama Equipment
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Company
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Stock Value
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Tanggal Activity
                 </th>
               </tr>
             </thead>
              <tbody>
                {filteredRecords.map((item, index) => (
                  <tr key={index}>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark ">
                      <p className="text-sm">{index + 1}</p>
                    </td>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                    <button style={{
                        backgroundColor: item.adddata_string === 'masuk' ? '#4CAF50' : '#F44336',
                        color: 'white',
                        border: 'none',
                        padding: '10px 20px',
                        borderRadius: '5px',
                        cursor: 'pointer',
                        outline: 'none',
                        boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
                        transition: 'all 0.3s ease'
                    }}>
                        {item.adddata_string}
                    </button>
                </td>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                      <p className="text-black dark:text-white">
                        {item && item.nama_equipment}
                      </p>
                    </td>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                      <p className="text-black dark:text-white">
                        {item && item.perusahaan}
                      </p>
                    </td>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                      <p className="text-black dark:text-white">
                        {item && (item.adddata !== null ? item.addata : item.mindata)}
                      </p>
                    </td>
                    <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                      <p>
                        {item &&
                          moment(item.created_at)
                            .tz("Asia/Makassar")
                            .format("DD-MM-YYYY ")}
                      </p>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
        ) : (
          <table className="w-full table-auto">
          <thead>
               <tr className="bg-gray-2 text-left dark:bg-meta-4">
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   NO
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Status
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Nama Equipment
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Company
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Stock Value
                 </th>
                 <th className="py-4 px-4 font-medium text-black dark:text-white">
                   Tanggal Activity
                 </th>
               </tr>
             </thead>
      
           </table>
        )}
      </div>
    </DefaultLayout>
  );
};

export default LogBarang;
