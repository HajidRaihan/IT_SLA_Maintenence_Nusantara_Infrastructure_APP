import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { getDetailActivity } from '../api/activityApi';
import { Link, useParams } from 'react-router-dom';
import TableDetailActivity from '../components/Tables/TableDetailActivity';

const ActivityDetail = () => {
  const [detail, setDetail] = useState();

  const { id } = useParams();

  useEffect(() => {
    const fetchActivity = async () => {
      const res = await getDetailActivity(id);
      console.log(res);
      setDetail(res.data);
    };
    fetchActivity();
  }, []);

  return (
    <DefaultLayout>
      {detail ? (
        <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
          <div className="flex gap-5">
            <img
              src={`http://127.0.0.1:8000/images/${detail.fotos}`}
              alt="sdsd"
              className="w-1/3 h-full"
            />
            <div>
              <TableDetailActivity data={detail} />
              <Link
                to="#"
                className={`my-5 w-full inline-flex items-center justify-center rounded-md bg-meta-3 py-4 px-10 text-center font-medium text-white hover:bg-opacity-90 lg:px-8 xl:px-10 ${
                  detail.status === 'done'
                    ? 'cursor-not-allowed opacity-50'
                    : 'cursor-pointer'
                }`}
              >
                {detail.status === 'done' ? 'Aproved' : 'Approve'}
              </Link>
            </div>
          </div>
        </div>
      ) : (
        ''
      )}
    </DefaultLayout>
  );
};

export default ActivityDetail;
