import React, { useEffect, useState } from 'react';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import ListActivityTable from '../components/Tables/ListActivityTable';
import DefaultLayout from '../layout/DefaultLayout';
import { getAllActivity, deleteActivity } from '../api/activityApi';

const ListActivity = () => {
  const [activity, setActivity] = useState([]);
  useEffect(() => {
    const fetchActivity = async () => {
      const response = await getAllActivity();
      console.log(response);
      setActivity(response.data);
    };
    fetchActivity();
  }, []);

  const deleteHandler = async (id) => {
    console.log('delete', id);

    try {
      const res = await deleteActivity(id);
      if (res) {
        const updatedData = activity.filter((item) => item.id !== id);
        setActivity(updatedData);
      }
      console.log(res);
    } catch (error) {
      throw error;
    }
  };
  return (
    <DefaultLayout>
      <Breadcrumb pageName="List Activity" />

      <div className="flex flex-col gap-10">
        <ListActivityTable data={activity} deleteHandler={deleteHandler} />
      </div>
    </DefaultLayout>
  );
};

export default ListActivity;
