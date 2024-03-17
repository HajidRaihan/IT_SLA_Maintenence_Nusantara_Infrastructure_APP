import { useState, useEffect } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DefaultLayout from '../layout/DefaultLayout';
import React, { Fragment } from 'react';
import { getKategori, addKategori,updateKategori,deleteKategori } from "../api/kategoriApi";

const Kategori = () => {
  const [data, setData] = useState([]);
  const [showForm, setShowForm] = useState(false);
  const [updateForm, setUpdateForm] = useState(false);
  const [deleteForm, setDeleteForm] = useState(false);
  const [newCategory, setNewCategory] = useState('');
  const [updateCategory, setUpdateCategory] = useState('');
  const [kategoriId, setKategoriId] = useState()

  useEffect(() => {
    getKategori().then(res => {
      setData(res);
    });
  }, []);

  

  const handleShowForm = () => {
    setShowForm(true);
  };

  const handleChangeUpdate = (e) => {
    setUpdateCategory(e.target.value);
  };

  const handleupdateForm = (id) => {
     setUpdateForm(true);
     setKategoriId(id)
  };

  const handledeleteForm = (id) => {
    setDeleteForm(true);
    setKategoriId(id);
  };

  const handleDelete = async () => {
    try {
      const res = await deleteKategori(kategoriId);
      // Filter out the deleted category from the state
      setData(data.filter(item => item.id !== kategoriId));
      setDeleteForm(false);
      console.log("Delete berhasil ",res)
    } catch (error) {
      console.error('Error deleting category:', error);
    }
  };

  

  const handleupdatecloseForm = () => {
    setUpdateForm(false);
    setUpdateCategory('');
 }

  const handleCloseForm = () => {
    setShowForm(false);
    setNewCategory('');
  };

  const handleChange = (e) => {
    setNewCategory(e.target.value);
  };

  const handleAddCategory = async () => {
    const data = {
        nama_kategori: newCategory,
    }

    console.log(data)

    const res = await addKategori(data);
    console.log(res)

    handleCloseForm();
  };


  const handleUpdate = async () => {
      const data = {
      nama_kategori: updateCategory,
    };
    

    console.log(data)
  
    try {
      const res = await updateKategori(kategoriId, data);
      console.log('Category updated successfully:', res);
      // Optionally, you can update the state or perform any other action after updating the category
    } catch (error) {
      console.error('Error updating category:', error);
      // Handle the error gracefully (e.g., display an error message to the user)
    }
    handleupdatecloseForm();
  };

 

  

  return (
    <DefaultLayout>
      <Breadcrumb pageName="Kategori" />
      <div className="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div className="py-6 px-4 md:px-6 xl:px-7.5 flex justify-between items-center">
          <h4 className="text-xl font-semibold text-black dark:text-white">
            Kategori
          </h4>
          <button
            onClick={handleShowForm}
            className="border border-stroke rounded-sm px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
          >
            Add Kategori
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

        {data?.map((item, index) => (
          <div
            className="grid grid-cols-6 border-t border-stroke py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5"
            key={index}
          >
            <div className="col-span-3 flex items-center">
              <p className="font-medium mr-2 text-black dark:text-white">{item.id}</p>
            </div>
            <div className="col-span-3 flex items-center sm:flex">
              <p className="font-medium mr-3 text-black dark:text-white">{item.nama_kategori}</p>
            </div>
            <div className="mb-10 flex items-center">
            <button  onClick = {() => handleupdateForm(item.id)} className="border border-stroke rounded-sm px-4 py-2 bg-green-500 dark:bg-boxdark shadow-default dark:border-strokedark text-black dark:text-white" >
  <h3 className="font-medium text-black dark:text-white text-sm">Update</h3>
</button>
<button onClick={() => handledeleteForm(item.id)} className="border border-stroke rounded-sm px-4 py-2 bg-red-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white">
                Delete
              </button>

            </div>
          </div>
        ))}
      </div>
      {/* Add Kategori Form */}
      {showForm && (
        <div className="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
          <div className="bg-white shadow-md rounded-md p-6">
            <h2 className="text-lg font-semibold mb-4">Add Kategori Form</h2>
            <input
              type="text"
              className="border border-stroke rounded-sm px-4 py-2 mb-4 w-full"
              placeholder="Enter category name"
              value={newCategory}
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
                onClick={handleAddCategory}
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
               <h2 className="text-lg font-semibold mb-4">Delete Kategori</h2>
               <p>Are you sure you want to delete this category?</p>
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
)
}

{updateForm && (
        <div className="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
          <div className="bg-black shadow-md rounded-md p-6">
            <h2 className="text-lg font-semibold mb-4">Add Kategori Form</h2>
            <input
              type="text"
              className="border border-stroke rounded-sm px-4 py-2 mb-4 w-full"
              placeholder="Enter Update name"
              value={updateCategory}
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

export default Kategori;
