import BrandOne from '../../images/brand/brand-01.svg';
import BrandTwo from '../../images/brand/brand-02.svg';
import BrandThree from '../../images/brand/brand-03.svg';
import BrandFour from '../../images/brand/brand-04.svg';
import BrandFive from '../../images/brand/brand-05.svg';
import React, { useState } from 'react';
import { deleteUser } from '../../api/userApi';

const TableUser = ({ data }) => {
  const [userId, setUserId] = useState();
  const deleteHandler = (id) => {
    return console.log(id);

    try {
      const res = deleteUser(id);
    } catch (error) {
      console.error(error);
    }
  };
  return (
    <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
      <h4 className="mb-6 text-xl font-semibold text-black dark:text-white">
        User
      </h4>

      <div className="flex flex-col">
        <div className="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
          <div className="p-2.5 xl:p-5">
            <h5 className="text-sm font-medium  xsm:text-base">No</h5>
          </div>
          <div className="p-2.5 xl:p-5">
            <h5 className="text-sm font-medium  xsm:text-base">Foto</h5>
          </div>
          <div className="p-2.5 xl:p-5">
            <h5 className="text-sm font-medium  xsm:text-base">Username</h5>
          </div>
          <div className="hidden p-2.5 sm:block xl:p-5">
            <h5 className="text-sm font-medium  xsm:text-base">Email</h5>
          </div>
          <div className="hidden p-2.5 sm:block xl:p-5">
            <h5 className="text-sm font-medium  xsm:text-base">Tanda Tangan</h5>
          </div>
        </div>

        {data?.map((item, key) => (
          <div
            className={`grid grid-cols-3 sm:grid-cols-5 ${
              key === data.length - 1
                ? ''
                : 'border-b border-stroke dark:border-strokedark'
            }`}
            key={key}
          >
            <div className="flex items-center p-2.5 xl:p-5">
              <p className="text-black dark:text-white">{key + 1}</p>
            </div>
            <div className="flex items-center gap-3 p-2.5 xl:p-5">
              <div className="flex-shrink-0">
                <img
                  src={`${import.meta.env.VITE_IMAGE_URL}/${item.foto}`}
                  alt="profile"
                  className="w-20 h-20 rounded-full object-cover object-center"
                />
              </div>
            </div>

            <div className="flex items-center p-2.5 xl:p-5">
              <p className="text-black dark:text-white">{item.username}</p>
            </div>
            <div className="flex items-center p-2.5 xl:p-5">
              <p className="text-black dark:text-white">{item.email}</p>
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

            {/* <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
              <p className="text-meta-5">{brand.conversion}%</p>
            </div> */}
          </div>
        ))}
      </div>
    </div>
  );
};

export default TableUser;
