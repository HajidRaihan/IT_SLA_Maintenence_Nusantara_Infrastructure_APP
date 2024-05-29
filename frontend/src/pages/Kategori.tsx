import { useState, useEffect } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DefaultLayout from '../layout/DefaultLayout';
import React, { Fragment } from 'react';
import { getKategori, addKategori, updateKategori, deleteKategori } from "../api/kategoriApi";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {faPlus } from '@fortawesome/free-solid-svg-icons';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import {KategoriModal} from '../components/Modals/AddModal';
import { useDisclosure } from "@nextui-org/react";
import Paginate from '../components/Pagination/paginate';
import DeleteModal from '../components/Modals/DeleteModal';
import { UpdateKategoriModal } from '../components/Modals/UpdateLokasiModal';


const Kategori = () => {
  const [data, setData] = useState([]);
  const [newCategory, setNewCategory] = useState('');
  const [newDurationString, setNewDurationString] = useState('');
  const [parsedDuration, setParsedDuration]= useState(null)
  const [updateCategory, setUpdateCategory] = useState('');
  const [CategoryId, setCategoryId] = useState('');
  const { isOpen: deleteModalOpen, onOpen: onDeleteModalOpen, onClose: onDeleteModalClose } = useDisclosure();
  const { isOpen: addModalOpen, onOpen: onAddModalOpen, onClose: onAddModalClose } = useDisclosure();
  const { isOpen: updateModalOpen, onOpen: onUpdateModalOpen, onClose: onUpdateModalClose } = useDisclosure();
 
  const [currentPage, setCurrentPage] = useState(1); // Current page state
  const itemsPerPage = 5; // Number of data items per page


  const parseDurationString = (input) => {
    // Logic to parse the duration string and convert it into milliseconds
    // For example, you can use a library like 'date-fns' or 'moment' for parsing
    // Here's a basic implementation using regular expressions:
    const match = input.match(/^(\d+)\s*(hour)s?$/);
    if (match) {
      const value = parseInt(match[1]);
      const unit = match[2];
      let durationInseconds = 0;
      switch (unit) {
        case 'hour':
          durationInseconds = value * 60 * 60 ;
          break;
        default:
          break;
      }
      return durationInseconds;
    }
    return null; // Return null if the input string doesn't match the expected format
  };




  // Calculate total number of pages
  const startIndex = (currentPage-1) * itemsPerPage ;
  const endIndex = Math.min(startIndex + itemsPerPage, data.length);

  // Filter the data to display only the items for the current page
  const currentItems = data.slice(startIndex, endIndex);



  const handlePageChange = (page) => {
    setCurrentPage(page); // Update the current page
  };


  const handleAddForm = () => {
    setNewCategory('');
    onAddModalOpen(); // Open the add modal
  };

  const handleUpdateForm = (id) => {
    setUpdateCategory('');
    setCategoryId(id);
    onUpdateModalOpen()
  };

  const handleDeleteForm = (id) => {
    setCategoryId(id);
    onDeleteModalOpen();
    
  }
  useEffect(() => {
    getKategori().then(res => {
      setData(res);
    });
  }, []);

  const handleDelete = async () => {
  try {
    const res = await deleteKategori(CategoryId);
    // Filter out the deleted location from the state
    setData(data.filter(item => item.id !== CategoryId));
    toast.success("Delete successfully ", res);
  } catch (error) {
    toast.error('Error deleting Category:', error);
  }
};

const convertsecondsToReadableString = (seconds) => {
  const minutes = Math.floor(seconds / 60);
  const hours = Math.floor(minutes / 60);
  const days = Math.floor(hours / 24);
  const weeks = Math.floor(days / 7);

  if (weeks > 0) {
    return `${weeks} week${weeks > 1 ? 's' : ''}`;
  } else if (days > 0) {
    return `${days} day${days > 1 ? 's' : ''}`;
  } else if (hours > 0) {
    return `${hours} hour${hours > 1 ? 's' : ''}`;
  } else if (minutes > 0) {
    return `${minutes} minute${minutes > 1 ? 's' : ''}`;
  
  }
};



const handleAddKategori = async () => {
  // Parse the duration string
  const parsedDuration = parseDurationString(newDurationString);

  if (parsedDuration === null) {
    toast.error('Invalid duration format');
    return;
  }

  const newKategoriData = {
    nama_kategori: newCategory,
    deadline_duration: parsedDuration, // Add the parsed duration to the data
  };

  try {
    const res = await addKategori(newKategoriData);
    const addedKategori = res.data;
    setData((prevData) => [...prevData, addedKategori]);
    toast.success('Category added successfully');
  } catch (error) {
    toast.error('Failed to add Category');
  }
};



 
  const handleUpdate = async () => {
    const dataToUpdate = {
      nama_kategori: updateCategory,
    };
    try {
      const res = await updateKategori(CategoryId, dataToUpdate);
      const updatedKategori = res.data;
      const updatedIndex = data.findIndex(item => item.id === CategoryId);
      if(updatedIndex !== -1) {
        setData(prevData => {
          const newData = [...prevData];
          newData[updatedIndex] = updatedKategori;
          return newData;
        })
      }
         toast.success('Category updated successfully :', res);
    } catch (error) {
      toast.error('Error updating category', error);
      // Handle the error gracefully (e.g., display an error message to the user)
    }
  
  };

  return (
    <DefaultLayout>
      <ToastContainer />
      <Breadcrumb pageName="Kategori" />
      <div className="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div className="py-6 px-4 md:px-6 xl:px-7.5 flex justify-between items-center">
          <h4 className="text-xl font-semibold text-black dark:text-white">
            Add Kategori
          </h4>
          <button
             onClick={handleAddForm} 
            className="border border-stroke rounded-sm px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
          >
            <FontAwesomeIcon icon={faPlus} className="green-light-icon text-lg" />
          </button>
        </div>

        <div className="grid grid-cols-4 border-t border-stroke py-4.5 px-4 dark:border-strokedark md:px-6 2xl:px-7.5">
  <div className="col-span-1 flex items-center">
    <p className="font-medium mr-2">No</p>
  </div>
  <div className="col-span-1 flex items-center">
    <p className="font-medium">Nama</p>
  </div>
  <div className="col-span-1 flex items-center">
    <p className="font-medium">Duration</p>
  </div>
  <div className="col-span-1 flex items-center">
    <p className="font-medium">Status</p>
  </div>
</div>


        {currentItems.map((item, index) => (
          <div
            className="grid grid-cols-4 border-t border-stroke py-4.5 px-4 dark:border-strokedark md:px-6 2xl:px-7.5"
            key={startIndex+index}
          >
            <div className="col-span-1 flex items-center">
              <p className="font-medium mr-2 text-black dark:text-white">{startIndex+index+1}</p>
            </div>
            <div className="col-span-1 flex items-center">
              <p className="font-medium mr-3 text-black dark:text-white">{item.nama_kategori}</p>
            </div>
            <div className="col-span-1 flex items-center">
               <p className="font-medium mr-3 text-black dark:text-white">{convertsecondsToReadableString(item.deadline_duration)}</p>
             </div>
            <div className="col-span-1 flex items-center">
              <button   onClick={() => handleUpdateForm(item.id)}  className="hover:text-primary">
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

              <button onClick={() => handleDeleteForm(item.id)} className="hover:text-primary">
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
            </div>
          </div>
        ))}
        </div>
      <div className='flex justify-center mt-4'>
      <Paginate currentPage={currentPage} onPageChange={handlePageChange}/></div>
      <KategoriModal isOpen={addModalOpen}  onAdd={handleAddKategori} onChangeKategori={(e) => setNewCategory(e.target.value)} OnChangeDuration= {(e) => setNewDurationString(e.target.value)} valuecategory={newCategory} valueduration = {newDurationString} onClose={onAddModalClose}/>
      <UpdateKategoriModal isUpdateOpen={updateModalOpen}  onAdd={handleUpdate} onChange={(e) => setUpdateCategory(e.target.value)} value={updateCategory} onUpdateClose={onUpdateModalClose}/>
      <DeleteModal isDeleteOpen={deleteModalOpen}  onDelete={handleDelete} onDeleteClose={onDeleteModalClose}/>
      
     

    </DefaultLayout>
  );
};

export default Kategori;
