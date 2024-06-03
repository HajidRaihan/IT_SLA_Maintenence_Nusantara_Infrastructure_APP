import React, { useState, useEffect } from 'react';
import ReactApexChart from 'react-apexcharts';
import { getAllActivityList } from '../../api/activityApi';

interface ActivityData {
  jenis_hardware: string;
  waktu_pengerjaan: string | null;
  updated_at: string; // Assuming updated_at is a string, change to Date if it's a Date object
}

interface ChartOneState {
  categories: string[];
  series: { name: string; data: number[] }[];
  totalWaktuPengerjaan: number;
  averageWaktuPengerjaan: number;
  maxCategory: string;
  maxWaktuPengerjaan: number;
}

const options = {
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    type: 'bar',
    height: 350,
    toolbar: {
      show: false,
    },
  },
  colors: ["#00008B"],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '70%',
      endingShape: 'rounded',
      startingShape: 'rounded',
    },
  },
  dataLabels: {
    enabled: true,
    offsetY: -20,
    style: {
      fontSize: '12px',
      colors: ["#000"]
    }
  },
  xaxis: {
    categories: [],
  },
  yaxis: {
    title: {
      text: 'Total Waktu Pengerjaan (minutes)',
    },
  },

};

const ChartOne: React.FC = () => {
  const [state, setState] = useState<ChartOneState>({
    categories: [],
    series: [
      {
        name: 'Waktu Pengerjaan',
        data: [],
      },
    ],
    totalWaktuPengerjaan: 0,
    averageWaktuPengerjaan: 0,
    maxCategory: '',
    maxWaktuPengerjaan: 0,
  });

  const [startYear, setStartYear] = useState<number>(2020); // Default start year
  const [endYear, setEndYear] = useState<number>(2024); // Default end year

  const fetchData = () => {
    getAllActivityList({ startYear, endYear })
      .then(res => {
        const data: ActivityData[] = res.data;
        
        // Filter out data that does not match the year range
        const filteredData = data.filter(item => {
          const updatedAtYear = new Date(item.updated_at).getFullYear();
          return updatedAtYear >= startYear && updatedAtYear <= endYear;
        });

        if (filteredData.length === 0) {
          // If no data found with the updated_at year range, reset state
          setState({
            categories: [],
            series: [
              {
                name: 'Waktu Pengerjaan',
                data: [],
              },
            ],
            totalWaktuPengerjaan: 0,
            averageWaktuPengerjaan: 0,
            maxCategory: '',
            maxWaktuPengerjaan: 0,
          });
          return;
        }

        const categoryTimeMap: Map<string, number> = new Map();
        let totalWaktuPengerjaan = 0;

        filteredData.forEach(item => {
          if (item.waktu_pengerjaan !== null) {
            const waktuPengerjaan = parseInt(item.waktu_pengerjaan, 10);
            totalWaktuPengerjaan += waktuPengerjaan;

            const categories = item.jenis_hardware.split(',').map(cat => cat.trim());
            categories.forEach(cat => {
              if (categoryTimeMap.has(cat)) {
                categoryTimeMap.set(cat, categoryTimeMap.get(cat)! + waktuPengerjaan);
              } else {
                categoryTimeMap.set(cat, waktuPengerjaan);
              }
            });
          }
        });

        const uniqueCategories = Array.from(categoryTimeMap.keys());
        const categoryTimes = uniqueCategories.map(cat => categoryTimeMap.get(cat)!);
        const averageWaktuPengerjaan = totalWaktuPengerjaan / uniqueCategories.length;

        let maxCategory = '';
        let maxWaktuPengerjaan = 0;
        categoryTimeMap.forEach((value, key) => {
          if (value > maxWaktuPengerjaan) {
            maxWaktuPengerjaan = value;
            maxCategory = key;
          }
        });

        setState({
          categories: uniqueCategories,
          series: [
            {
              name: 'Waktu Pengerjaan',
              data: categoryTimes,
            },
          ],
          totalWaktuPengerjaan,
          averageWaktuPengerjaan,
          maxCategory,
          maxWaktuPengerjaan,
        });
      })
      .catch(error => {
        console.error('Error fetching activity data:', error);
      });
  };

  useEffect(() => {
    fetchData();
  }, [startYear, endYear]); // Trigger fetchData whenever startYear or endYear changes

  return (
    <div className="sm:px-7.5 col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-5">
      <div className="mb-3 justify-between gap-4 sm:flex">
        <div>
          <h5 className="text-xl font-semibold text-black dark:text-white">
            Hardware Performance
          </h5>
        </div>
        <div>
          <label className="mr-2">Start Year:</label>
          <input
            type="number"
            value={startYear}
            onChange={(e) => setStartYear(parseInt(e.target.value, 10))}
            className="border rounded p-1"
          />
          <label className="mx-2">End Year:</label>
          <input
            type="number"
            value={endYear}
            onChange={(e) => setEndYear(parseInt(e.target.value, 10))}
            className="border rounded p-1"
          />
   
        </div>
      </div>

      <div className="mb-2">
        <div id="chartOne" className="mx-auto flex justify-center">
          <ReactApexChart
            options={{
              ...options,
              xaxis: {
                ...options.xaxis,
                categories: state.categories.map(String),
              },
            }}
            series={state.series}
            type="bar"
            height={350}
          />
        </div>
      </div>

      <div className="mt-6">
        <h6 className="text-lg font-semibold text-black dark:text-white mb-2">Summary</h6>
        <div className="flex flex-wrap justify-between">
          <div className="w-full md:w-1/3 p-2">
            <div className="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
              <h6 className="text-md font-medium text-black dark:text-white">Average Waktu Pengerjaan</h6>
              <p className="text-2xl font-bold text-blue-600">{state.averageWaktuPengerjaan.toFixed(2)} minutes</p>
            </div>
          </div>
          <div className="w-full md:w-1/3 p-2">
            <div className="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
              <h6 className="text-md font-medium text-black dark:text-white">Category with Max Waktu Pengerjaan</h6>
              <p className="text-2xl font-bold text-blue-600">{state.maxCategory}</p>
              <p className="text-md font-medium text-black dark:text-white">{state.maxWaktuPengerjaan} minutes</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ChartOne;
