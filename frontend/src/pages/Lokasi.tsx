import { useState, useEffect } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DefaultLayout from '../layout/DefaultLayout';
import React, { Fragment } from 'react';
import { getLokasi, addLokasi, updateLokasi, deleteLokasi } from "../api/lokasiApi";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faTrash, faPen, faPlus } from '@fortawesome/free-solid-svg-icons';


const Lokasi = () => {
  const [data, setData] = useState([]);
  const [showForm, setShowForm] = useState(false);
  const [updateForm, setUpdateForm] = useState(false);
  const [deleteForm, setDeleteForm] = useState(false);
  const [newlokasi, setNewlokasi] = useState('');
  const [updatelokasi, setUpdatelokasi] = useState('');
  const [lokasiId, setlokasiId] = useState();
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(5); // Change this value to set the number of items per page

  useEffect(() => {
    getLokasi().then(res => {
      setData(res);
    });
  }, []);

  // Pagination
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = data.slice(indexOfFirstItem, indexOfLastItem);

  const paginate = pageNumber => setCurrentPage(pageNumber);

  const handleShowForm = () => {
    setShowForm(true);
  };

  const handleChangeUpdate = (e) => {
    setUpdatelokasi(e.target.value);
  };

  const handleupdateForm = (id) => {
    setUpdateForm(true);
    setlokasiId(id);
  };

  const handledeleteForm = (id) => {
    setDeleteForm(true);
    setlokasiId(id);
  };

  const handleDelete = async () => {
    try {
      const res = await deleteLokasi(lokasiId);
      // Filter out the deleted lokasi from the state
      setData(data.filter(item => item.id !== lokasiId));
      setDeleteForm(false);
      console.log("Delete berhasil ", res)
    } catch (error) {
      console.error('Error deleting lokasi:', error);
    }
  };

  const handleupdatecloseForm = () => {
    setUpdateForm(false);
    setUpdatelokasi('');
  };

  const handleCloseForm = () => {
    setShowForm(false);
    setNewlokasi('');
  };

  const handleChange = (e) => {
    setNewlokasi(e.target.value);
  };

  const handleAddlokasi = async () => {
    const data = {
      nama_lokasi: newlokasi,
    }

    console.log(data)

    const res = await addLokasi(data);
    console.log(res)

    handleCloseForm();
  };


  const handleUpdate = async () => {
    const data = {
      nama_lokasi: updatelokasi,
    };


    console.log(data)

    try {
      const res = await updateLokasi(lokasiId, data);
      console.log('Location updated successfully:', res);
      // Optionally, you can update the state or perform any other action after updating the location
    } catch (error) {
      console.error('Error updating location:', error);
      // Handle the error gracefully (e.g., display an error message to the user)
    }
    handleupdatecloseForm();
  };

  return (
    <DefaultLayout>
      <Breadcrumb pageName="Lokasi" />
      <div className="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div className="py-6 px-4 md:px-6 xl:px-7.5 flex justify-between items-center">
          <h4 className="text-xl font-semibold text-black dark:text-white">
            Add Lokasi
          </h4>
          <button
            onClick={handleShowForm}
            className="border border-stroke rounded-sm px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
          >
            <FontAwesomeIcon icon={faPlus} className="green-light-icon text-lg" />
          </button>
        </div>

        <div className="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
          <div className="col-span-3 flex items-center">
            <p className="font-medium mr-2">No</p>
          </div>
          <div className="col-span-3 flex items-center sm:flex">
            <p className="font-medium">Nama</p>
          </div>
          <div className="col-span-1 flex items-center">
            <p className="font-medium">Status</p>
          </div>
        </div>

        {currentItems.map((item, index) => (
          <div
            className="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5"
            key={index}
          >
            <div className="col-span-3 flex items-center">
              <p className="font-medium mr-2 text-black dark:text-white">{item.id}</p>
            </div>
            <div className="col-span-3 flex items-center sm:flex">
              <p className="font-medium mr-3 text-black dark:text-white">{item.nama_lokasi}</p>
            </div>
            <div className="mb-3  flex items-center">
              <button onClick={() => handleupdateForm(item.id)} className="border border-stroke rounded-sm px-4 py-2 bg-green-600 dark:bg-boxdark shadow-default dark:border-strokedark text-black dark:text-white flex items-center justify-center">
                <FontAwesomeIcon icon={faPen} className="green-light-icon text-lg" />
              </button>

              <button onClick={() => handledeleteForm(item.id)} className="border border-stroke rounded-sm px-4 py-2 bg-red-700 dark:bg-boxdark shadow-default dark:border-strokedark text-white flex items-center justify-center">
                <FontAwesomeIcon icon={faTrash} className="text-lg" />
              </button>
            </div>
          </div>
        ))}
      </div>

      {/* Pagination */}
      <div className="flex justify-center mt-4">
        <button
          onClick={() => paginate(currentPage - 1)}
          disabled={currentPage === 1}
          className="border border-stroke rounded-sm px-4 py-2 bg-blue-500 text-white mr-2"
        >
          Previous
        </button>
        <button
          onClick={() => paginate(currentPage + 1)}
          disabled={indexOfLastItem >= data.length}
          className="border border-stroke rounded-sm px-4 py-2 bg-blue-500 text-white"
        >
          Next
        </button>
      </div>

      {/* Add Lokasi Form */}
      {showForm && (
        <div className="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
          <div className="bg-black shadow-md rounded-md p-6">
            <h2 className="text-lg font-semibold mb-4">Add Lokasi Form</h2>
            <input
              type="text"
              className="border border-stroke rounded-sm px-4 py-2 mb-4 w-full"
              placeholder="Enter location name"
              value={newlokasi}
              onChange={handleChange}
            />
            <div className="flex justify-end">
              <button
                onClick={handleCloseForm}
                className="mr-2 border border-stroke rounded-sm px-4 py-2 bg-red-500 text-white"
              >
                Cancel
              </button>
              <button
                onClick={handleAddlokasi}
                className="border border-stroke rounded-sm px-4 py-2 bg-green-500 text-white"
              >
                Add
              </button>

            </div>
          </div>
        </div>
      )}

      {deleteForm && (
        <div className="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
          <div className="bg-white shadow-md rounded-md p-6">
            <h2 className="text-lg font-semibold mb-4">Delete Lokasi</h2>
            <p>Are you sure you want to delete this location?</p>
            <div className="flex justify-end mt-4">
              <button
                onClick={() => setDeleteForm(false)}
                className="mr-2 border border-stroke rounded-sm px-4 py-2 bg-red-500 text-white"
              >
                Cancel
              </button>
              <button
                onClick={handleDelete}
                className="border border-stroke rounded-sm px-4 py-2 bg-green-500 text-white"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      )}

      {updateForm && (
        <div className="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
          <div className="bg-black shadow-md rounded-md p-6">
            <h2 className="text-lg font-semibold mb-4">Update Form</h2>
            <input
              type="text"
              className="border border-stroke rounded-sm px-4 py-2 mb-4 w-full"
              placeholder="Enter Update name"
              value={updatelokasi}
              onChange={handleChangeUpdate}
            />
            <div className="flex justify-end">
              <button
                onClick={handleupdatecloseForm}
                className="mr-2 border border-stroke rounded-sm px-4 py-2 bg-red-500 text-white"
              >
                Cancel
              </button>
              <button
                onClick={handleUpdate}
                className="border border-stroke rounded-sm px-4 py-2 bg-green-500 text-white"
              >
                Add
              </button>
            </div>
          </div>
        </div>
      )}
    </DefaultLayout>
  );
};

export default Lokasi;
