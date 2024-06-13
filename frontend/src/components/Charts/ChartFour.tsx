import { ApexOptions } from 'apexcharts';
import React, { useState, useEffect } from 'react';
import ReactApexChart from 'react-apexcharts';
import { getJadwal } from '../../api/JadwalApi';

interface ChartThreeState {
  series: number[];
}



const options: ApexOptions = {
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    type: 'donut',
  },
  colors: ["#00008B", "#ADD8E6", "#FF6347"],
  labels: ['On Time', 'Late', 'Not Done'],
  legend: {
    show: false,
    position: 'bottom',
  },
  plotOptions: {
    pie: {
      startAngle: 0,
      endAngle: 360,
      expandOnClick: false,
    },
  },
  dataLabels: {
    enabled: false,
  },
};

const ChartFour: React.FC = () => {
  const [state, setState] = useState<ChartThreeState>({
    series: [0, 0, 0],
  });
  const [selectedYear, setSelectedYear] = useState<number>(new Date().getFullYear()); // Tambahkan state tahun dan set ke tahun sekarang

  useEffect(() => {
    getJadwal(selectedYear) // Gunakan tahun yang dipilih sebagai parameter
      .then(res => {
        const onTimeCount = res.filter(item => item.status === 'on time').length;
        const lateCount = res.filter(item => item.status === 'late').length;
        const notDoneCount = res.filter(item => item.status === 'not done').length;
        setState({ series: [onTimeCount, lateCount, notDoneCount] });
      })
      .catch(error => {
        console.error('Error fetching jadwal data:', error);
      });
  }, [selectedYear]); // Tambahkan selectedYear sebagai dependensi

  const sumStatus = state.series.reduce((acc, curr) => acc + curr, 0);

  return (
    <div className="col-span-12 rounded-sm border border-stroke bg-white p-5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-5">
      <div className="mb-3 flex justify-between items-center">
        <h5 className="text-xl font-semibold text-black dark:text-white">Jadwal Performance</h5>
        <select value={selectedYear} onChange={(e) => setSelectedYear(parseInt(e.target.value))} className="border rounded px-2 py-1">
          {/* Tambahkan opsi untuk memilih tahun */}
          <option value={2024}>2024</option>
          <option value={2025}>2025</option>
          {/* Tambahkan opsi lain sesuai kebutuhan */}
        </select>
      </div>
      <div className="mb-2">
        <div id="chartThree" className="mx-auto flex justify-center">
          <ReactApexChart options={options} series={state.series} type="donut" />
        </div>
      </div>
      <div className="flex flex-wrap items-center justify-center gap-y-2 gap-x-4">
        <StatusItem color="#00008B" label="On Time" count={state.series[0]} total={sumStatus} />
        <StatusItem color="#ADD8E6" label="Late" count={state.series[1]} total={sumStatus} />
        <StatusItem color="#FF6347" label="Not Done" count={state.series[2]} total={sumStatus} />
        <StatusItem color="#B0B0B0" label="All Status" count={sumStatus} total={sumStatus} />
      </div>
    </div>
  );
};

const StatusItem: React.FC<{ color: string, label: string, count: number, total: number }> = ({ color, label, count, total }) => {
  const percentage = total > 0 ? ((count / total) * 100).toFixed(2) : '0.00';
  return (
    <div className="flex items-center space-x-2">
      <span className={`block h-3 w-3 rounded-full`} style={{ backgroundColor: color }}></span>
      <p className="text-sm font-medium text-black dark:text-white">
        <span>{label}:</span> <span>{count} ({percentage}%)</span>
      </p>
    </div>
  );
};

export default ChartFour;
