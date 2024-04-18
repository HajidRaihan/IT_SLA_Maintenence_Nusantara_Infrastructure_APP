            import React, { useEffect, useState } from 'react';
            import DefaultLayout from '../layout/DefaultLayout';
            import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
            import { addBarang,getBarang,updateBarang } from '../api/BarangApi';
            import { faPlus } from '@fortawesome/free-solid-svg-icons';
            import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
            import { toast, ToastContainer } from 'react-toastify';
            import 'react-toastify/dist/ReactToastify.css';
            import { BarangModal } from '../components/Modals/AddModal';
            import { UpdateBarangModal } from '../components/Modals/UpdateLokasiModal';
            import {UpdateBarangModalMin} from '../components/Modals/UpdateLokasiModal';
            import { useDisclosure } from '@nextui-org/modal';
            import Paginate from '../components/Pagination/paginate';
            const ListBarang = () => {
                const [data, setData] = useState([]);
                const [newEquipment, setNewEquipment] = useState('');
                const [newMerk, setNewMerk] = useState('');
                const [BarangId, setBarangId] = useState('');
                const [updateStock, setUpdateStock] = useState<number>(0);
                const [updateStockMin, setUpdateStockMin] = useState(0);
                const { isOpen: addModalOpen, onOpen: onAddModalOpen, onClose: onAddModalClose } = useDisclosure();
                const { isOpen: updateModalOpen, onOpen: onUpdateModalOpen, onClose: onUpdateModalClose } = useDisclosure();
                const { isOpen: updateModalMinOpen, onOpen: onUpdateModalMinOpen, onClose: onUpdateModalMinClose } = useDisclosure();
                const [newStock, setNewStock] = useState(0);
                const [newPicture, setNewPicture] = useState();
                const [selectedCompany, setSelectedCompany] = useState('');
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

                
                const handleUpdateForm = (id) => {
                    setBarangId(id);
                    onUpdateModalOpen();
                };

                const handleUpdateFormMin = (id) => {
                    setBarangId(id);
                    onUpdateModalMinOpen();
                };
            
                const handleUpdateStock = async () => {
                    // Ensure updateStock is parsed as an integer
                    const stockToAdd = updateStock;
                
                    if (isNaN(stockToAdd) || stockToAdd <= 0) {
                        toast.error('Error: Stock should be a positive number');
                        return;
                    }
                
                    try {
                        const itemToUpdate = data.find(item => item.id === BarangId);
                        if (!itemToUpdate) {
                            throw new Error('Error: Barang not found');
                        }
                
                        const updatedStock = itemToUpdate.stock + stockToAdd;
                        const log_barang = 'masuk'; // No need to convert string to String object
                
                        const dataToUpdate = {
                            stock: updatedStock,
                            adddata_string: log_barang,
                            addata: stockToAdd,
                        };
                
                        const res = await updateBarang(BarangId, dataToUpdate);
                        const updatedBarang = res.data;
                
                        const updatedIndex = data.findIndex(item => item.id === BarangId);
                        if (updatedIndex !== -1) {
                            setData(prevData => {
                                const newData = [...prevData];
                                newData[updatedIndex] = updatedBarang;
                                return newData;
                            });
                        }
                
                        toast.success(`Stock updated successfully: ${updatedStock}`);
                    } catch (error) {
                        toast.error('Error updating stock:', error.message);
                        // Handle the error gracefully (e.g., display an error message to the user)
                    }
                };
                
                

                  const handleUpdateMinStock = async () => {
                    if (updateStockMin <= 0) {
                      toast.error('Error: Stock should be a positive number');
                      return;
                    }
                  
                    try {
                      const itemToUpdate = data.find(item => item.id === BarangId);
                      if (!itemToUpdate) {
                        throw new Error('Error: Barang not found');
                      }
                  
                      const updatedStock = itemToUpdate.stock - updateStockMin;
                      const log_barang = String('keluar');
                  
                      const dataToUpdate = {
                        stock: updatedStock,
                        adddata_string:log_barang,
                        addata:updateStockMin
                      };
                  
                      const res = await updateBarang(BarangId, dataToUpdate);
                      const updatedBarang = res.data;
                  
                      const updatedIndex = data.findIndex(item => item.id === BarangId);
                      if (updatedIndex !== -1) {
                        setData(prevData => {
                          const newData = [...prevData];
                          newData[updatedIndex] = updatedBarang;
                          return newData;
                        });
                      }
                  
                      toast.success(`Stock updated successfully: ${updatedStock}`);
                    } catch (error) {
                      toast.error('Error updating stock:', error.message);
                      // Handle the error gracefully (e.g., display an error message to the user)
                    }
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



                const handleEquipment = e => {
                    setNewEquipment(e.target.value);
                };
                const handleMerk = e => {
                    setNewMerk(e.target.value);
                };
                const handleCompany = e => {
                    setSelectedCompany(e.target.value);
                };

               
                const handleStock = e => {
                    setNewStock(parseInt(e.target.value)); // Parse input value to integer
                };

                const UpdatehandleStock = (e) => {
                    const newValue = parseInt(e.target.value); // Parse input value to integer
                    setUpdateStock(newValue);
                  };


                  const UpdatehandleStockMin = (e) => {
                    const newValue = parseInt(e.target.value); // Parse input value to integer
                    setUpdateStockMin(newValue);
                  };

                    const handleAddBarang = async() => {
                    // Prevent default form submission behavior
    
                        const newBarangData = {
                            nama_equipment: newEquipment,
                            merk: newMerk,
                            perusahaan: selectedCompany,
                            stock: newStock,
                            gambar: newPicture,
                        };

                        try {
                            const res = await addBarang(newBarangData);
                            const addedBarang = res.data;
                            setData(prevData => [...prevData, addedBarang]);
                            toast.success('Barang added successfully!', res);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                    
                        } catch (error) {
                            toast.error('Failed to add ');
                        }
                    };
                const handlePictureChange = (e) => {
                setNewPicture(e.target.files[0]);

                };
                 const handleAddForm = () => {
                    
                    onAddModalOpen();
                }
                return (
                    <DefaultLayout>
                        <ToastContainer/>
                        <Breadcrumb pageName="Barang" />
                        <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                            <div className='flex items-center'>
                            <h4 className="mb-6 text-xl font-semibold text-black dark:text-white">
                                List Barang
                            </h4>
                            <button
                        onClick={handleAddForm}
                        className="ml-auto border border-stroke rounded-sm px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
                    >
                        <FontAwesomeIcon
                        icon={faPlus}
                        className="green-light-icon text-lg"
                        />
                    </button>
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
                Company
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Merk
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Stock
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Gambar
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Action
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
                  <p className="text-black dark:text-white">
                    {item.perusahaan}
                  </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p className="text-black dark:text-white">
                    {item.merk}
                  </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                  <p className="text-black dark:text-white">
                    {item.stock}
                  </p>
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <img src={`http://127.0.0.1:8000/images/${item.gambar}`} alt="Descriptive text" style={{ width: '200px', height: '100px' }} />
                </td>
                <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
                <button
                                className="hover:text-primary"
                                onClick={() => handleUpdateForm(item.id)} 
                                >
                                <svg
                                    className="fill-current"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <g opacity="0.8" clipPath="url(#clip0_88_10224)">
                                    <path
                                        fillRule="evenodd"
                                        clipRule="evenodd"
                                        d="M1.56524 3.23223C2.03408 2.76339 2.66997 2.5 3.33301 2.5H9.16634C9.62658 2.5 9.99967 2.8731 9.99967 3.33333C9.99967 3.79357 9.62658 4.16667 9.16634 4.16667H3.33301C3.11199 4.16667 2.90003 4.25446 2.74375 4.41074C2.58747 4.56702 2.49967 4.77899 2.49967 5V16.6667C2.49967 16.8877 2.58747 17.0996 2.74375 17.2559C2.90003 17.4122 3.11199 17.5 3.33301 17.5H14.9997C15.2207 17.5 15.4326 17.4122 15.5889 17.2559C15.7452 17.0996 15.833 16.8877 15.833 16.6667V10.8333C15.833 10.3731 16.2061 10 16.6663 10C17.1266 10 17.4997 10.3731 17.4997 10.8333V16.6667C17.4997 17.3297 17.2363 17.9656 16.7674 18.4344C16.2986 18.9033 15.6627 19.1667 14.9997 19.1667H3.33301C2.66997 19.1667 2.03408 18.9033 1.56524 18.4344C1.0964 17.9656 0.833008 17.3297 0.833008 16.6667V5C0.833008 4.33696 1.0964 3.70107 1.56524 3.23223Z"
                                        fill=""
                                    />
                                    <path
                                        fillRule="evenodd"
                                        clipRule="evenodd"
                                        d="M16.6664 2.39884C16.4185 2.39884 16.1809 2.49729 16.0056 2.67253L8.25216 10.426L7.81167 12.188L9.57365 11.7475L17.3271 3.99402C17.5023 3.81878 17.6008 3.5811 17.6008 3.33328C17.6008 3.08545 17.5023 2.84777 17.3271 2.67253C17.1519 2.49729 16.9142 2.39884 16.6664 2.39884ZM14.8271 1.49402C15.3149 1.00622 15.9765 0.732178 16.6664 0.732178C17.3562 0.732178 18.0178 1.00622 18.5056 1.49402C18.9934 1.98182 19.2675 2.64342 19.2675 3.33328C19.2675 4.02313 18.9934 4.68473 18.5056 5.17253L10.5889 13.0892C10.4821 13.196 10.3483 13.2718 10.2018 13.3084L6.86847 14.1417C6.58449 14.2127 6.28409 14.1295 6.0771 13.9225C5.87012 13.7156 5.78691 13.4151 5.85791 13.1312L6.69124 9.79783C6.72787 9.65131 6.80364 9.51749 6.91044 9.41069L14.8271 1.49402Z"
                                        fill=""
                                    />
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_88_10224">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                    </defs>
                                </svg>
                               </button>

                        <button
                            className="hover:text-primary"
                            onClick={() => handleUpdateFormMin(item.id)} 
                        >
                            <svg
                                    className="fill-current"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                    d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z"
                                    fill=""
                                    />
                                    <path
                                    d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z"
                                    fill=""
                                    />
                                    <path
                                    d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z"
                                    fill=""
                                    />
                                    <path
                                    d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z"
                                    fill=""
                                    />
                                </svg>
                        </button> 
             
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
                            <BarangModal 
            isOpen={addModalOpen}  
            onAdd={handleAddBarang} 
            onChangeEquipment={handleEquipment}
            onChangeMerk={handleMerk}
            onChangeStock={handleStock}
            onChangePicture={handlePictureChange}
            onChangeCompany={handleCompany}
            valueEquipment={newEquipment}
            valueMerk={newMerk}
            valueStock={newStock}
            valueCompany={selectedCompany}
            onClose={onAddModalClose}/>
            <div className='flex justify-center mt-4'>
         <Paginate currentPage={currentPage} onPageChange={handlePageChange}/></div>
            <UpdateBarangModal  isUpdateOpen={updateModalOpen} onAdd = {handleUpdateStock} onUpdateStock={UpdatehandleStock} valueUpdateStock={updateStock} onUpdateClose={onUpdateModalClose}
                  />

            <UpdateBarangModalMin  isUpdateOpen={updateModalMinOpen} onAdd = {handleUpdateMinStock} onUpdateStock={UpdatehandleStockMin} valueUpdateStock={updateStockMin} onUpdateClose={onUpdateModalMinClose}
                  />
            </DefaultLayout>
                );
            };

            export default ListBarang;
