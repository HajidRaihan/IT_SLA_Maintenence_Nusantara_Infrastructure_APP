import React, { useEffect, useState } from 'react';
import DefaultLayout from '../layout/DefaultLayout';
import { getDetailActivity } from '../api/activityApi';
import { useParams } from 'react-router-dom';
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
              className="w-1/3"
            />
            <TableDetailActivity data={detail} />
          </div>
        </div>
      ) : (
        ''
      )}
    </DefaultLayout>
  );
};

export default ActivityDetail;
