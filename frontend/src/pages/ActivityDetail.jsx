import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { getDetailActivity } from '../api/activityApi';
import { Link, useParams } from 'react-router-dom';
import { changeStatus } from '../api/activityApi';
import ChangeStatusModal from '../components/Modals/ChangeStatusModal';
import { toast, ToastContainer } from 'react-toastify';
import { useDisclosure, Button } from '@nextui-org/react';
import TableDetailActivity from '../components/Tables/TableDetailActivity';
import DoneActivityTable from '../components/Tables/DoneActivityTable';

const ActivityDetail = () => {
  const [detail, setDetail] = useState();
  const [fotoAkhir, setfotoAkhir] = useState();
  const [kondisiAkhir, setKondisiAkhir] = useState();

  const { isOpen, onOpen, onOpenChange } = useDisclosure();

  const { id } = useParams();

  useEffect(() => {
    const fetchActivity = async () => {
      const res = await getDetailActivity(id);
      console.log(res.data.data);
      setDetail(res.data.data[0]);
    };
    fetchActivity();
  }, []);

  const handleApprove = async () => {
    const data = {
      status: 'done',
      foto_akhir: fotoAkhir,
      kondisi_akhir: kondisiAkhir,
    };
    try {
      const res = await changeStatus(id, data);
      console.log(res);
    } catch (error) {
      console.error(error);
    }
  };

  const toastErrorMessage = (message) => {
    toast.error(message);
  };

  return (
    <DefaultLayout>
      {detail ? (
        <>
          <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <div className="flex gap-5">
              <img
                src={`http://127.0.0.1:8000/images/${detail.foto_awal}`}
                alt="sdsd"
                className="w-1/3 h-full"
              />
              <div className="w-full">
                <TableDetailActivity data={detail} />
                <Button
                  onPress={onOpen}
                  className={`my-5 w-full inline-flex items-center justify-center rounded-md bg-meta-3 py-4 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 ${
                    detail.status === 'done'
                      ? 'cursor-not-allowed opacity-50'
                      : 'cursor-pointer'
                  }`}
                  // isDisabled={detail.status === 'done'}
                >
                  {detail.status === 'done' ? 'Aproved' : 'Approve'}
                </Button>
              </div>
            </div>
          </div>
          {detail.status === 'done' && (
            <div className="mt-10 rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
              <h1 className="text-3xl font-semibold text-black dark:text-white text-center uppercase">
                Handled
              </h1>
              <div className="h-0.5 mb-10 bg-stroke mt-5" />
              <div className="flex gap-5 mb-10">
                <img
                  src={`http://127.0.0.1:8000/images/${detail.foto_akhir}`}
                  alt="foto akhir"
                  className="w-1/3 h-full"
                />
                <div className="w-full">
                  <DoneActivityTable data={detail} />
                </div>
              </div>
            </div>
          )}
        </>
      ) : (
        ''
      )}
      <ToastContainer autoClose={2000} />

      <ChangeStatusModal
        isOpen={isOpen}
        onOpenChange={onOpenChange}
        id={id}
        toastSuccess={() => toast.success('Success Approve Activity')}
        toastError={toastErrorMessage}
      />
    </DefaultLayout>
  );
};

export default ActivityDetail;
