import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import { getBarang,addBarang } from "../api/BarangApi";
import { faPlus } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
const ListBarang = () => {
    const [data, setData] = useState([]);
    const [showForm, setShowForm] = useState(false);
    const [newEquipment, setNewEquipment] = useState('');
    const [newMerk, setNewMerk] = useState('');
    const [newCompany, setNewCompany] = useState('');
    const [newStock, setNewStock] = useState(0);
    const [newPicture, setNewPicture] = useState();
    const [newUnit, setNewUnit] = useState('');


    useEffect(() => {
        getBarang()
            .then(res => {
                setData(res);
            })
            .catch(error => {
                console.error('Error fetching barang data:', error);
            });
    }, []);

    const handleShowForm = () => {
        setShowForm(true);
    };

    const handleEquipment = e => {
        setNewEquipment(e.target.value);
    };
    const handleMerk = e => {
        setNewMerk(e.target.value);
    };
    const handleCompany = e => {
        setNewCompany(e.target.value);
    };

    const handleUnit = e => {
        setNewUnit(e.target.value);
    };
    const handleStock = e => {
        setNewStock(parseInt(e.target.value)); // Parse input value to integer
    };

    const handleAddCategory = async e => {
        e.preventDefault(); // Prevent default form submission behavior

        const newEquipmentData = {
            nama_equipment: newEquipment,
            merk: newMerk,
            perusahaan: newCompany,
            stock: newStock,
            gambar: newPicture,
            unit:newUnit
        };

        try {
            const res = await addBarang(newEquipmentData);
            const addedBarang = res.data;
            setData(prevData => [...prevData, addedBarang]);
            toast.success('Barang added successfully!', res);
            setShowForm(false);
        } catch (error) {
            toast.error('Failed to add category');
        }
    };

    const handlePictureChange = (e) => {
        setNewPicture(e.target.files[0]);
    };

    const closeForm = () => {
        setShowForm(false);
    }
    return (
        <DefaultLayout>
            <ToastContainer/>
            <Breadcrumb pageName="Tables" />
            <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                <div className='flex items-center'>
                <h4 className="mb-6 text-xl font-semibold text-black dark:text-white">
                    List Barang
                </h4>
                <button
            onClick={handleShowForm}
            className="ml-auto border border-stroke rounded-sm px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
          >
            <FontAwesomeIcon
              icon={faPlus}
              className="green-light-icon text-lg"
            />
          </button>
          </div>
                <div className="flex flex-col">
                    <div className="grid grid-cols-8rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-8">
                        <div className="p-2.5 xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">No</h5>
                        </div>
                        <div className="pt-2.5 pr-2.5 pb-2.5 pl-0 xl:pl-0">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Nama Equipment</h5>
                        </div> <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Company</h5>
                        </div>

                        <div className="p-2.5 text-center xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Unit</h5>
                        </div>
                        <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Merk</h5>
                        </div>
                         <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Stock</h5>
                        </div>
                        <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Gambar</h5>
                        </div>
                        <div className="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 className="text-sm font-medium uppercase xsm:text-base">Action</h5>
                        </div>
                       
                    </div>

                    {data.map((item, index) => (
                       <div className="grid grid-cols-8 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-8" key={index}>
                       <div className="p-2.5 xl:p-5">
                           <p>{index + 1}</p>
                       </div>
                       <div className="p-2.5 text-center xl:p-3">
                           <p>{item.nama_equipment}</p>
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
                       <div className="p-2.5 text-center xl:p-5">
                           <p>{item.stock}</p>
                       </div>
                       <div className="p-2.5 xl:p-5">
                           <img src={`http://127.0.0.1:8000/images/${item.gambar}`} alt="Descriptive text" style={{ width: '200px', height: '100px' }} />
                       </div>
                   </div>
                    ))}
                </div>
            </div>
            {showForm && (
    <div className="fixed top-0 z-200 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50">
        <div className="bg-white rounded-lg shadow-lg overflow-hidden w-80 z-200"> {/* Increased z-index value */}
            <div className="px-6 py-4">
                <h3 className="font-medium text-black dark:text-white">Add Form</h3>
            </div>
            <form action="#" className="p-6.5 grid grid-cols-2 gap-4">
                <div className="grid grid-cols-1">
                    <label className="mb-2.5 block text-black dark:text-black">
                        Nama equipment
                    </label>
                    <input
                        type="text"
                        onChange={handleEquipment}
                        value = {newEquipment}
                        className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                </div>
                <div className="grid grid-cols-1">
                    <label className="mb-2.5 block text-black dark:text-black">
                        Perusahaan
                    </label>
                    <input
                        value={newCompany}
                        type="text"
                        onChange={handleCompany}
                        className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                </div>
                <div className="grid grid-cols-1">
                    <label className="mb-2.5 block text-black dark:text-black">
                        Merk
                    </label>
                    <input
                        value={newMerk}
                        type='text'
                        onChange={handleMerk}
                        className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                </div>
                <div className="grid grid-cols-1">
                    <label className="mb-2.5 block text-black dark:text-black">
                        Stock
                    </label>
                    <input
                        value={newStock}
                        type="number"
                        onChange={handleStock}
                        className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                </div>
                <div className="grid grid-cols-1">
                                <label className="mb-2.5 block text-black dark:text-black">
                                    Gambar
                                </label>
                                <input
                                    onChange={handlePictureChange}
                                    type="file"
                                    className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                                />
                                 </div>

                                 <div className="grid grid-cols-1">
                    <label className="mb-2.5 block text-black dark:text-black">
                        Unit
                    </label>
                    <input
                        value={newUnit}
                        type="text"
                        onChange={handleUnit}
                        className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    />
                </div>
                <div className="col-span-2 flex justify-end">
                    <button
                        onClick={closeForm}
                        className="mr-2 border border-stroke rounded-sm px-4 py-2 bg-red-500 text-white"
                    >
                        Cancel
                    </button>
                    <button
                        className="border border-stroke rounded-sm px-4 py-2 bg-green-500 text-white"
                        onClick={handleAddCategory}
                    >
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
)}

        </DefaultLayout>
    );
};

export default ListBarang;
