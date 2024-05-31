import React, { useEffect, useState } from 'react';
import html2pdf from 'html2pdf.js';
import Logo from '../../assets/logo/logo1.jpg';
import './Pdf.css';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
} from '@nextui-org/react';
import { getJenisHardware } from '../../api/jenisHardwareApi';
import { getJenisSoftware } from '../../api/jenisSoftwareApi';
import { getAplikasiTol } from '../../api/aplikasiTolApi';

const PdfModal = ({ isOpen, onOpenChange, data }) => {
  const [jenisHardwareData, setJenisHardwareData] = useState();
  const [jenisSoftwareData, setJenisSoftwareData] = useState();
  const [aplikasiItTolData, setAplikasiItTolData] = useState();

  useEffect(() => {
    const fetchHardware = async () => {
      const res = await getJenisHardware();
      console.log({ res });

      setJenisHardwareData(
        res.filter(
          (hardware) =>
            data.jenis_hardware &&
            data.jenis_hardware.includes(hardware.nama_hardware),
        ),
      );
    };
    fetchHardware();
  }, []);

  useEffect(() => {
    const fetchSoftware = async () => {
      const res = await getJenisSoftware();
      console.log({ res });

      setJenisSoftwareData(
        res.filter(
          (software) =>
            data.standart_aplikasi &&
            data.standart_aplikasi.includes(software.nama_software),
        ),
      );
    };
    fetchSoftware();
  }, []);

  useEffect(() => {
    const fetchAplikasi = async () => {
      const res = await getAplikasiTol();
      console.log({ res });
      // Menggunakan Set untuk menyaring nilai-nilai unik

      setAplikasiItTolData(
        res.filter(
          (aplikasi) =>
            data.aplikasi_it_tol &&
            data.aplikasi_it_tol.includes(aplikasi.nama_aplikasiTol),
        ),
      );
    };
    fetchAplikasi();
  }, []);

  const generatePDF = () => {
    const element = document.getElementById('pdf-content');
    const opt = {
      margin: 0,
      filename: 'Form.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
    };
    html2pdf().set(opt).from(element).save();
  };

  return (
    <>
      <Modal
        className="border-stroke bg-whiter shadow-default dark:border-strokedark dark:bg-black h-[500px] "
        isOpen={isOpen}
        onOpenChange={onOpenChange}
        size="2xl"
      >
        <ModalContent className="overflow-y-scroll">
          {(onClose) => (
            <>
              <ModalHeader className="dark:text-white flex flex-col gap-1">
                Preview
              </ModalHeader>
              <ModalBody>
                <div className="PdfModal ml-5 mr-5 bg-white ">
                  {jenisHardwareData &&
                  jenisSoftwareData &&
                  aplikasiItTolData &&
                  data ? (
                    <div id="pdf-content" className="form-content p-5 text-xs">
                      <table className="w-full mb-2">
                        <tr>
                          <td className="border w-1/3 p-2">
                            <div className="flex items-center justify-center">
                              <div>
                                <img
                                  src={Logo}
                                  alt="Logo"
                                  className="w-32 mb-2"
                                />
                              </div>
                            </div>
                          </td>
                          <td className="border w-1/3 p-2">
                            <div className="flex items-center justify-center h-full">
                              <h1 className="text-center text-lg font-bold">
                                Form Maintenance & Permintaan Perbaikan
                              </h1>
                            </div>
                          </td>
                          <td className="border w-1/3 text-xs">
                            <table className="w-full border-collapse">
                              <tr>
                                <td className="border-r p-2">No Dok :</td>
                                <td className=" p-2">FO-MMN-MIS-02-03</td>
                              </tr>
                              <tr>
                                <td className="border-r border-t p-2">
                                  Tgl Terbit :
                                </td>
                                <td className="border-t p-2">--/--/----</td>
                              </tr>
                              <tr>
                                <td className="border-r border-t p-2">
                                  No. Rev :
                                </td>
                                <td className="border-t p-2">05</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>

                      <div className="mb-2">
                        <div className="flex items-center gap-3">
                          <p>Periode (diisi oleh user)</p>
                          <input type="checkbox" />
                          <p>:</p>
                          <input type="checkbox" name="" id="" />
                        </div>
                        <div className="flex gap-36">
                          <p>
                            Nama Lengkap (user) &nbsp;&nbsp;&nbsp;:{' '}
                            {data.nama_user}
                          </p>
                          <p>Lokasi&emsp;&ensp;&nbsp; : </p>
                          <p>Tgl : </p>
                        </div>
                        <div className="flex gap-[145px] ">
                          <p>
                            Departemen/Shift
                            &emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {data.shift}
                          </p>
                          <p>Jabatan &emsp;:</p>
                        </div>
                      </div>

                      <div className="mb-2">
                        <div className="flex items-center mb-1">
                          <span className="font-bold">Hardware:</span>
                          <input type="checkbox" className="ml-2" /> Tol
                          <input type="checkbox" className="ml-2" /> Non Tol
                        </div>
                        {/* <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <div className="flex items-center justify-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="ml-3">Jenis Hardware</span>
                                </div>
                              </th>
                              <th className="border p-1 w-1/6">
                                <div className="flex items-center">Kondisi</div>
                              </th>
                              <th className="border p-1 w-1/2">
                                <div className="flex items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="text-red-500 ml-3">
                                    Mohon dijabarkan Permasalahan**
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            {jenisHardwareData.map((hardware, index) => {
                              return (
                                <tr key={index}>
                                  <td className="border p-1">
                                    <div className="flex items-center">
                                      <input
                                        type="checkbox"
                                        className="mr-2"
                                        checked={
                                          data.jenis_hardware &&
                                          data.jenis_hardware.includes(
                                            hardware.nama_hardware,
                                          )
                                        }
                                      />
                                      {hardware.nama_hardware}
                                    </div>
                                  </td>
                                  <td className="border p-1">
                                    {data.jenis_hardware &&
                                    data.jenis_hardware.includes(
                                      hardware.nama_hardware,
                                    )
                                      ? data.kondisi_akhir
                                      : ''}
                                  </td>
                                  <td className="border p-1">
                                    {data.jenis_hardware &&
                                    data.jenis_hardware.includes(
                                      hardware.nama_hardware,
                                    )
                                      ? data.uraian_hardware
                                      : ''}
                                  </td>
                                </tr>
                              );
                            })}
                          </tbody>
                        </table> */}
                        <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <div className="flex items-center justify-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="ml-3">Jenis Hardware</span>
                                </div>
                              </th>
                              <th className="border p-1 w-1/8">
                                <div className="flex items-center">Kondisi</div>
                              </th>
                              <th className="border p-1 w-1/2">
                                <div className="flex items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="text-red-500 ml-3">
                                    Mohon dijabarkan Permasalahan**
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            {jenisHardwareData.map((hardware, index) => (
                              <tr key={index}>
                                <td className="border p-1">
                                  <div className="flex items-center">
                                    <input
                                      type="checkbox"
                                      className="mr-2"
                                      checked={
                                        data.jenis_hardware &&
                                        data.jenis_hardware.includes(
                                          hardware.nama_hardware,
                                        )
                                      }
                                    />
                                    {hardware.nama_hardware}
                                  </div>
                                </td>
                                <td className="border p-1">
                                  <input type="checkbox" className="ml-2" />
                                </td>
                                {index === 0 && (
                                  <td
                                    className="border p-1 one-line"
                                    rowSpan={jenisHardwareData.length}
                                  >
                                    <p>{data.uraian_hardware}</p>
                                  </td>
                                )}
                              </tr>
                            ))}
                          </tbody>
                        </table>
                      </div>

                      <div className="">
                        <div className="mb-1 flex items-center">
                          <span className="font-bold">Software:</span>
                          <input type="checkbox" className="ml-2" /> Tol
                          <input type="checkbox" className="ml-2" /> Non Tol
                        </div>
                        <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <div className="flex justify-center items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="ml-3">
                                    Standard Aplikasi
                                  </span>
                                </div>
                              </th>
                              <th className="border p-1 w-1/6">
                                <div className="flex justify-center items-center">
                                  Kondisi
                                </div>
                              </th>
                              <th className="border p-1 w-1/2">
                                <div className="flex justify-center items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="text-red-500 ml-3">
                                    Mohon dijabarkan Permasalahan**
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            {jenisSoftwareData.map((software, index) => {
                              return (
                                <tr key={index}>
                                  <td className="border p-1">
                                    <div className="flex items-center">
                                      <input
                                        type="checkbox"
                                        className="mr-2"
                                        checked={
                                          data.standart_aplikasi &&
                                          data.standart_aplikasi.includes(
                                            software.nama_software,
                                          )
                                        }
                                      />
                                      {software.nama_software}
                                    </div>
                                  </td>
                                  <td className="border p-1">
                                    <input type="checkbox" className="ml-2" />
                                  </td>
                                  {index === 0 && (
                                    <td
                                      className="border p-1 one-line"
                                      rowSpan={jenisHardwareData.length}
                                    >
                                      <p>{data.uraian_hardware}</p>
                                    </td>
                                  )}
                                </tr>
                              );
                            })}
                          </tbody>
                        </table>
                        <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <div className="flex justify-center items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="ml-3">
                                    Aplikasi IT & Peralatan Tol
                                  </span>
                                </div>
                              </th>
                              <th className="border p-1 w-1/6">
                                <div className="flex justify-center items-center">
                                  Kondisi
                                </div>
                              </th>
                              <th className="border p-1 w-1/2">
                                <div className="flex justify-center items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="text-red-500 ml-3">
                                    Mohon dijabarkan Permasalahan**
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            {aplikasiItTolData.map((aplikasi, index) => {
                              return (
                                <tr key={index}>
                                  <td className="border p-1">
                                    <div className="flex items-center">
                                      <input
                                        type="checkbox"
                                        className="mr-2"
                                        checked={
                                          data.aplikasi_it_tol &&
                                          data.aplikasi_it_tol.includes(
                                            aplikasi.nama_aplikasiTol,
                                          )
                                        }
                                      />
                                      {aplikasi?.nama_aplikasiTol}
                                    </div>
                                  </td>
                                  <td className="border p-1">
                                    <input type="checkbox" className="ml-2" />
                                  </td>
                                  {index === 0 && (
                                    <td
                                      className="border p-1 one-line"
                                      rowSpan={jenisHardwareData.length}
                                    >
                                      <p>{data.uraian_hardware}</p>
                                    </td>
                                  )}
                                </tr>
                              );
                            })}
                          </tbody>
                        </table>
                        <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <div className="flex justify-center items-center">
                                  <input type="checkbox" name="" id="" />
                                  <span className="ml-3 text-sm text-red-500">
                                    Catatan***
                                  </span>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td className="border p-1 h-20">
                                {data.catatan}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <table className="w-full border-collapse mb-2">
                          <thead>
                            <tr className="bg-gray-200">
                              <th className="border p-1 w-1/3">
                                <span className="text-red-500">
                                  *Mengetahui (Atasan IT)
                                </span>
                              </th>
                              <th className="border p-1 w-1/6">
                                <span className="text-red-500">
                                  Pengecekan Oleh (IT)
                                </span>
                              </th>
                              <th className="border p-1 w-1/2 ">
                                <span className="text-red-500 ml-3">
                                  User (Teknisi)
                                </span>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr className="h-15">
                              <td className="border p-1"></td>
                              <td className="border p-1"></td>
                              <td className="border p-1"></td>
                            </tr>
                            <tr className="h-6">
                              <td className="border p-1">
                                <span className="text-red-500 font-bold">
                                  Nama:
                                </span>
                              </td>
                              <td className="border p-1">
                                <span className="text-red-500 font-bold">
                                  Nama:
                                </span>
                              </td>
                              <td className="border p-1">
                                <span className="text-red-500 font-bold">
                                  Nama:
                                </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p className="text-red-500">
                          Catatan: User dapat mengisi kolom kosong jika item
                          kerusakan tidak terlist dalam form. Ext hanya di isi
                          untuk lokasi gerbang. User dapat memilih pilihan
                          dengan memberi lingkaran pada opsi yang dimaksud. "*"
                          dapat diisi dihari dan jam operasional normal. "**"
                          Dapat diisi oleh user untuk permintaan perbaikan atau
                          diisi oleh IT untuk maintenance. "***" Diisi oleh IT.
                          "****" Ditandatangani oleh Teknisi{' '}
                        </p>
                      </div>
                    </div>
                  ) : (
                    <p>loading ...</p>
                  )}
                </div>
              </ModalBody>

              <ModalFooter className="flex justify-center">
                <Button
                  color="primary"
                  onPress={generatePDF}
                  className="w-full"
                >
                  Cetak
                </Button>
              </ModalFooter>
            </>
          )}
        </ModalContent>
      </Modal>
    </>
  );
};

export default PdfModal;
