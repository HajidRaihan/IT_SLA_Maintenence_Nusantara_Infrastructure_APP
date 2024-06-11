import React, { useEffect, useState } from 'react';
import CardDataStats from '../../components/CardDataStats';
import ChartOne from '../../components/Charts/ChartOne';
import ChartThree from '../../components/Charts/ChartThree';
import ChartFour from '../../components/Charts/ChartFour';
import ChartTwo from '../../components/Charts/ChartTwo';
import ChatCard from '../../components/Chat/ChatCard';
import MapOne from '../../components/Maps/MapOne';
import TableOne from '../../components/Tables/TableOne';
import DefaultLayout from '../../layout/DefaultLayout';
import { getGrafikWorkDuration } from '../../api/grafikApi';
import WorkDurationChart from '../../components/Charts/WorkDurationChart';
import { faArrowRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { Button } from '@nextui-org/react';
import { useNavigate } from 'react-router-dom';
// import ChartFour from './ChartFour';

const ECommerce: React.FC = () => {
  const [dataGrafikWork, setDataGrafikWork] = useState();
  const [year, setYear] = useState([]);
  const [selectedYear, setSelectedYear] = useState(new Date().getFullYear());
  const navigate = useNavigate();

  useEffect(() => {
    const getGrafik = async () => {
      const res = await getGrafikWorkDuration(selectedYear, 'true');
      console.log('ini data dari api', res);

      // console.log({ convertToHour });

      // setDataGrafikWork({
      //   series: [
      //     {
      //       name: 'waktu pengerjaan',
      //       data: convertToHour,
      //     },
      //   ],
      // });
      setDataGrafikWork(res);
      const yearSet = new Set();

      for (let i = res.start_year; i <= res.end_year; i++) {
        console.log(i);
        yearSet.add(i);
      }

      // Konversi Set menjadi Array
      setYear([...yearSet]);
      console.log({ year });
    };
    getGrafik();
  }, [selectedYear]);

  const selectedYearHanlder = (e) => {
    setSelectedYear(e.target.value);
    console.log(e.target.value);
  };

  return (
    <DefaultLayout>
      <div className=" col-span-12 rounded-sm border border-stroke p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4 mb-5">
        <h4 className="text-xl font-bold text-black dark:text-white mb-5">
          Grafik Waktu Kerja
        </h4>
        <div className="flex-1 w-32 lg:ml-3">
          <select
            value={selectedYear}
            onChange={selectedYearHanlder}
            style={{
              width: '100%',
              padding: '5px',
              border: '',
              borderRadius: '5px',
            }}
            className="dark:bg-boxdark dark:border-strokedark border border-[#ccc]"
          >
            {year.map((option, index) => (
              <option key={index} value={option}>
                {option}
              </option>
            ))}
          </select>
        </div>
        <div className="mb-10 flex flex-wrap">
          {dataGrafikWork &&
            dataGrafikWork.data.map((data, index) => {
              return (
                <div className="lg:w-1/2 w-full" key={index}>
                  <WorkDurationChart data={data} />
                </div>
              );
            })}
        </div>
        <div className="flex justify-end items-center">
          <Button
            onClick={() => navigate('grafik-kerja')}
            className="border text-xs font-medium flex justify-center items-center border-stroke rounded-lg px-4 py-2 bg-blue-500 dark:bg-boxdark shadow-default dark:border-strokedark text-white"
          >
            <p>Selengkapnya</p>
            <FontAwesomeIcon
              icon={faArrowRight}
              className="green-light-icon text-md"
            />
          </Button>
        </div>
      </div>


      <div className="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
        <ChartOne />
        <ChartTwo />
        <ChartThree />
        <ChartFour />
      </div>
    </DefaultLayout>
  );
};

export default ECommerce;
