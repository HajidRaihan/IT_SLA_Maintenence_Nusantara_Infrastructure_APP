import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { getEmployee, deleteEmployee } from '../api/employeeApi';
import { Button, useDisclosure } from '@nextui-org/react';
import { toast, ToastContainer } from 'react-toastify';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPlus } from '@fortawesome/free-solid-svg-icons';
import AddEmployeeModal from '../components/Modals/AddEmployeeModal';

const EmployeeList = () => {
  const [employeeData, setEmployeeData] = useState([]);
  const { isOpen, onOpen, onOpenChange } = useDisclosure();

  useEffect(() => {
    const fetchEmployee = async () => {
      try {
        const res = await getEmployee();
        console.table(res);
        setEmployeeData(res);
      } catch (error) {
        console.error('Error fetching employee data:', error);
      }
    };

    fetchEmployee();
  }, []);

  const deleteHandler = async (id) => {
    try {
      const res = await deleteEmployee(id);
      console.log(res);
      setEmployeeData((prevData) =>
        prevData.filter((employee) => employee.id !== id),
      );
      toast.success('Berhasil delete user');
    } catch (error) {
      console.error('Error deleting employee:', error);
    }
  };

  return (
    <DefaultLayout>
      <ToastContainer />
      <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
        <div className="pb-6 px-4 flex justify-between items-center">
          <h4 className="text-lg font-semibold text-black dark:text-white">
            User (Teknisi / KSPT)
          </h4>
          <div className="flex items-center gap-3">
            <button
              onClick={onOpen}
              className="flex items-center rounded-full px-1 py-1 bg-blue-300 dark:bg-boxdark shadow-default text-white"
            >
              <div className="w-6 h-6 flex items-center justify-center bg-white rounded-full shadow-md">
                <FontAwesomeIcon
                  icon={faPlus}
                  className="text-blue-500 text-md"
                />
              </div>
              <span className="ml-2"></span>
            </button>
          </div>
        </div>

        <div className="flex flex-col">
          <div className="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-4">
            <div className="p-2.5 xl:p-5">
              <h5 className="text-sm font-medium xsm:text-base">No</h5>
            </div>

            <div className="p-2.5 xl:p-5">
              <h5 className="text-sm font-medium xsm:text-base">Name</h5>
            </div>

            <div className="hidden p-2.5 sm:block xl:p-5">
              <h5 className="text-sm font-medium xsm:text-base">
                Tanda Tangan
              </h5>
            </div>
            <div className="hidden p-2.5 sm:block xl:p-5">
              <h5 className="text-sm font-medium xsm:text-base">Action</h5>
            </div>
          </div>

          {employeeData.map((item, key) => (
            <div
              className={`grid grid-cols-3 sm:grid-cols-4 ${
                key === employeeData.length - 1
                  ? ''
                  : 'border-b border-stroke dark:border-strokedark'
              }`}
              key={key}
            >
              <div className="flex items-center p-2.5 xl:p-5">
                <p className="text-black dark:text-white">{key + 1}</p>
              </div>

              <div className="flex items-center p-2.5 xl:p-5">
                <p className="text-black dark:text-white">{item.nama}</p>
              </div>

              <div className="flex items-center gap-3 p-2.5 xl:p-5">
                <div className="flex-shrink-0">
                  <img
                    src={`${import.meta.env.VITE_IMAGE_URL}/${item.ttd}`}
                    alt="ttd"
                    className="w-20 h-20 object-cover object-center"
                  />
                </div>
              </div>
              <div className="flex items-center p-2.5 xl:p-5">
                <Button
                  color="danger"
                  size="sm"
                  onClick={() => deleteHandler(item.id)}
                >
                  Delete
                </Button>
              </div>
            </div>
          ))}
        </div>
      </div>
      <AddEmployeeModal
        isOpen={isOpen}
        onOpenChange={onOpenChange}
        toastSuccess={() => toast.success('Berhasil Menambahkan User')}
        toastError={() => toast.error('Gagal Menambahkan User')}
        setEmployeeData={setEmployeeData}
      />
    </DefaultLayout>
  );
};

export default EmployeeList;
