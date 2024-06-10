import { ApexOptions } from 'apexcharts';
import React, { useState, useEffect } from 'react';
import ReactApexChart from 'react-apexcharts';
import { getJadwal } from '../../api/JadwalApi';
import moment from 'moment-timezone';

interface ChartThreeState {
  series: number[];
}

const options: ApexOptions = {
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    type: 'donut', // Change the chart type to 'donut'
  },
  colors: ["#00008B", "#ADD8E6", "#FF6347"], // Colors for 'on time', 'late', and 'not done' statuses
  labels: ['on time', 'late', 'not done'], // Labels for 'on time', 'late', and 'not done' statuses
  legend: {
    show: false,
    position: 'bottom',
  },
  plotOptions: {
    pie: {
      startAngle: 0, // Set start angle to 0 degrees
      endAngle: 360, // Set end angle to 360 degrees
      expandOnClick: false, // Disable expanding on click
    },
  },
  dataLabels: {
    enabled: false,
  },
};

const ChartFour: React.FC = () => {
  const [state, setState] = useState<ChartThreeState>({
    series: [0, 0, 0], // Initialize series with 0 for 'on time', 'late', and 'not done' statuses
  });

  useEffect(() => {
    getJadwal()
      .then(res => {
        const onTimeCount = res.filter(item => item.status === 'on time').length;
        const lateCount = res.filter(item => item.status === 'late').length;
        const notDoneCount = res.filter(item => item.status === 'not done').length;
        setState({ series: [onTimeCount, lateCount, notDoneCount] });
      })
      .catch(error => {
        console.error('Error fetching barang data:', error);
      });
  }, []);

  const sumstatus = state.series.reduce((acc, curr) => acc + curr, 0);

  return (
    <div className="sm:px-7.5 col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-5">
      <div className="mb-3 justify-between gap-4 sm:flex">
        <div>
          <h5 className="text-xl font-semibold text-black dark:text-white">
            Jadwal Status
          </h5>
        </div>
        <div>
        </div>
      </div>

      <div className="mb-2">
        <div id="chartThree" className="mx-auto flex justify-center">
          <ReactApexChart
            options={options}
            series={state.series}
            type="donut"
          />
        </div>
      </div>

      <div className="-mx-8 flex flex-wrap items-center justify-center gap-y-3">
        <div className="sm:w-1/3 w-full px-8">
          <div className="flex w-full items-center">
            <span className="mr-2 block h-3 w-full max-w-3 rounded-full bg-primary"></span>
            <p className="flex w-full justify-between text-sm font-medium text-black dark:text-white">
              <span> on time </span>
              <span> {state.series[0]} ({((state.series[0] / sumstatus) * 100).toFixed(2)}%) </span>
            </p>
          </div>
        </div>
        <div className="sm:w-1/3 w-full px-8">
          <div className="flex w-full items-center">
            <span className="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#ADD8E6]"></span>
            <p className="flex w-full justify-between text-sm font-medium text-black dark:text-white">
              <span> late </span>
              <span> {state.series[1]} ({((state.series[1] / sumstatus) * 100).toFixed(2)}%) </span>
            </p>
          </div>
        </div>
        <div className="sm:w-1/3 w-full px-8">
          <div className="flex w-full items-center">
            <span className="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#FF6347]"></span>
            <p className="flex w-full justify-between text-sm font-medium text-black dark:text-white">
              <span> not done </span>
              <span> {state.series[2]} ({((state.series[2] / sumstatus) * 100).toFixed(2)}%) </span>
            </p>
          </div>
        </div>
        <div className="sm:w-1/3 w-full px-8">
          <div className="flex w-full items-center">
            <span className="mr-2 block h-3 w-full max-w-3 rounded-full bg-gray-400"></span>
            <p className="flex w-full justify-between text-sm font-medium text-black dark:text-white">
              <span> All status </span>
              <span> {sumstatus} </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ChartFour;
