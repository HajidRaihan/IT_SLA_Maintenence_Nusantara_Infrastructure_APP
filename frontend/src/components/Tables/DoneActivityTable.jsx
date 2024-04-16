import React, { useState, useEffect } from 'react';
import { differenceInMinutes, differenceInSeconds, format } from 'date-fns';

const DoneActivityTable = ({ data }) => {
  const [tanggalSelesai, setTanggalSelesai] = useState();
  const [tanggalMulai, setTanggalMulai] = useState();
  const [lamaHandle, setLamaHandle] = useState();

  
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

  function totalSeconds({ hari, jam, menit, detik }) {
    return hari * 24 * 60 * 60 + jam * 60 * 60 + menit * 60 + detik;
  }

  useEffect(() => {
    const tanggalMulaiFormat = data.created_at
      //   .replace('T', ' ')
      .replace('Z', '')
      .replace(/\.\d+/g, '');

    console.log({ tanggalMulaiFormat });
    const tanggalSelesaiFormat = data.ended_at.replace(' ', 'T');
    console.log({ tanggalSelesaiFormat });

    const selisihDetik = differenceInSeconds(
      tanggalSelesaiFormat,
      tanggalMulaiFormat,
    );
    console.log({ selisihDetik });
    const lama = konversiDetik(selisihDetik);
    console.log({ lama });
    setLamaHandle(lama);
    setTanggalSelesai(format(tanggalSelesaiFormat, 'd MMMM yyyy, HH:mm:ss'));
    setTanggalMulai(format(tanggalMulaiFormat, 'd MMMM yyyy, HH:mm:ss'));
  }, []);

  function konversiDetik(detik) {
    const hari = Math.floor(detik / (60 * 60 * 24));
    const sisaDetik = detik % (60 * 60 * 24);
    const jam = Math.floor(sisaDetik / (60 * 60));
    const sisaDetik2 = sisaDetik % (60 * 60);
    const menit = Math.floor(sisaDetik2 / 60);
    const sisaDetik3 = sisaDetik2 % 60;

    return { hari, jam, menit, detik: sisaDetik3 };
  }

  const hasil = konversiDetik(200000);
  console.log({ hasil });

  return (
    <div className="w-full rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
      <div className="max-w-full overflow-x-auto">
        <table className="w-full table-fixed">
          <tr>
            <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
              <h5 className="font-medium text-black dark:text-white">
                Tanggal Report
              </h5>
            </td>
            <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p className="text-black dark:text-white">{tanggalMulai}</p>
            </td>
          </tr>
          <tr>
            <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
              <h5 className="font-medium text-black dark:text-white">
                Tanggal Selesai
              </h5>
            </td>
            <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p className="text-black dark:text-white">{tanggalSelesai}</p>
            </td>
          </tr>

          <tr>
            <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
              <h5 className="font-medium text-black dark:text-white">
                Waktu Handle
              </h5>
            </td>
            <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p className="text-black dark:text-white">
                {lamaHandle
                  ? `
                  ${lamaHandle.hari !== 0 ? lamaHandle.hari + ' Hari ' : ''} 
                    ${lamaHandle.jam !== 0 ? lamaHandle.jam + ' Jam ' : ''}  
                    ${
                      lamaHandle.menit !== 0 ? lamaHandle.menit + ' Menit ' : ''
                    }  
                    ${lamaHandle.detik} Detik`
                  : '-'}
              </p>
            </td>
          </tr>
          <tr>
            <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
              <h5 className="font-medium text-black dark:text-white">
                Kondisi Akhir
              </h5>
            </td>
            <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p className="text-black dark:text-white">{data.kondisi_akhir}</p>
            </td>
          </tr>
          <tr>
            <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
              <h5 className="font-medium text-black dark:text-white">
                duration
              </h5>
            </td>
            <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
              <p className="text-black dark:text-white">{convertsecondsToReadableString(data.category_deadline)}</p>
            </td>
          </tr>
          <tr>
  <td className="border-b border-[#eee] py-5 px-4 pl-9 dark:border-strokedark xl:pl-11">
    <h5 className="font-medium text-black dark:text-white">
      Duration Result
    </h5>
  </td>
  <td className="border-b border-[#eee] py-5 px-4 dark:border-strokedark">
    {lamaHandle && totalSeconds(lamaHandle) <= data.category_deadline ? (
      <button className="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow">On Time</button>
    ) : (
      <button className="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow">Late</button>
    )}
  </td>
</tr>


        </table>
      </div>
    </div>
  );
};

export default DoneActivityTable;