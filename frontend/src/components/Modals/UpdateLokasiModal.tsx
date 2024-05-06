import React, { useState, useEffect } from 'react';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
  Input,
} from '@nextui-org/react';
import { getLokasi } from '../../api/lokasiApi.js';


function UpdateLokasiModal({
  isUpdateOpen,
  onUpdateClose,
  onAdd,
  value,
  onChange,
}) {
  return (
    <>
      <Modal
        isOpen={isUpdateOpen}
        onClose={onUpdateClose}
        placement="top-center"
      >
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">
              Update Lokasi
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Lokasi"
                placeholder="Enter your lokasi"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onUpdateClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function UpdateKategoriModal({
  isUpdateOpen,
  onUpdateClose,
  onAdd,
  value,
  onChange,
}) {
  return (
    <>
      <Modal
        isOpen={isUpdateOpen}
        onClose={onUpdateClose}
        placement="top-center"
      >
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">
              Update Kategori
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                label="Kategori"
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                placeholder="Enter your Kategori"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onUpdateClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function UpdateBarangModal({
  isUpdateOpen,
  onUpdateClose,
  onAdd,
  valueUpdateStock,
  onUpdateStock,
}) {
  return (
    <>
      <Modal
        isOpen={isUpdateOpen}
        onClose={onUpdateClose}
        placement="top-center"
      >
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">
              Update Stock
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={valueUpdateStock}
                onChange={onUpdateStock}
                label="Stock"
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                placeholder="Update your Stock"
                type="number"
                min="0"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onUpdateClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function UpdateBarangModalMin({
  isUpdateOpen,
  onUpdateClose,
  onAdd,
  valueUpdateStock,
  onUpdateStock,
}) {
  return (
    <>
      <Modal
        isOpen={isUpdateOpen}
        onClose={onUpdateClose}
        placement="top-center"
      >
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">
              Update Stock
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={valueUpdateStock}
                onChange={onUpdateStock}
                label="Stock"
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                placeholder="Update your Stock"
                type="number"
                min="0"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onUpdateClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function UpdateJadwalModal({
  isUpdateOpen,
  onUpdateClose,
  onAdd,
  onChangeUpdateJenisPerusahaan,
  onChangeUpdateLokasi,
  onChangeUpdateUraianKegiatan,
  onChangeUpdateWaktu,
  onChangeUpdateFrekuensi,
  onChangeUpdateTahun,
  valueUpdateLokasi,
  valueUpdateJenisPerusahaan,
  valueUpdateWaktu,
  valueUpdateUraianKegiatan,
  valueUpdateFrekuensi,
  valueUpdateTahun,
}) {
  const [JadwalOptions, setJadwalOptions] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await getLokasi();
        if (Array.isArray(res)) {
          setJadwalOptions(res);
        } else {
          // Handle incorrect response
          console.error('Invalid response:', res);
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };
    fetchData();
  }, []);

  const renderTanggalInputs = () => {
    if (!valueUpdateFrekuensi) return null;
    const jumlahTanggal = parseInt(
      valueUpdateFrekuensi.replace('x pertahun', ''),
    );
    const inputs = [];
    for (let i = 0; i < jumlahTanggal; i++) {
      inputs.push(
        <div key={i} className="flex flex-col gap-2">
          <label htmlFor={`tanggal${i}`} className="text-black">
            Tanggal {i + 1}
          </label>
          <Input
            id={`tanggal${i}`}
            type="date"
            value={valueUpdateWaktu[i] || ''}
            onChange={(e) => onChangeUpdateWaktu(i, e)}
            className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            placeholder={`Pilih Tanggal ${i + 1}`}
          />
        </div>,
      );
    }
    return inputs;
  };

  return (
    <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
      <ModalContent>
      <ModalHeader className="flex flex-col gap-1">Update Jadwal</ModalHeader>
      <ModalBody>
        <div className="flex flex-col gap-2">
          <div className="flex flex-col gap-2">
            <label htmlFor="jenisPerusahaan" className="text-black">
              Jenis Perusahaan
            </label>
            <select
              id="jenisPerusahaan"
              value={valueUpdateJenisPerusahaan}
              onChange={onChangeUpdateJenisPerusahaan}
              className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            >
              <option value="">Select Perusahaan</option>
              <option value="tol">Tol</option>
              <option value="non tol">Non Tol</option>
            </select>
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="uraianKegiatan" className="text-black">
              Uraian Kegiatan
            </label>
            <textarea
              id="uraianKegiatan"
              value={valueUpdateUraianKegiatan}
              onChange={onChangeUpdateUraianKegiatan}
              className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
              placeholder="Masukkan Uraian Kegiatan"
              rows={3}
            />
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="lokasi" className="text-black">
              Lokasi
            </label>
            <select
              value={valueUpdateLokasi}
              onChange={onChangeUpdateLokasi}
              className="w-full p-2 border rounded"
            >
              <option value="">Select Lokasi</option>
              {JadwalOptions.map((option) => (
                <option key={option.id} value={option.nama_lokasi}>
                  {option.nama_lokasi}
                </option>
              ))}
            </select>
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="tahun" className="text-black">
              Tahun
            </label>
            <input
              id="tahun"
              type="number"
              value={valueUpdateTahun}
              onChange={onChangeUpdateTahun}
              className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
              placeholder="Masukkan Tahun"
              min="1"
            />
          </div>
          <div className="flex flex-col gap-2">
            <label htmlFor="frekuensi" className="text-black">
              Frekuensi
            </label>
            <select
              id="frekuensi"
              value={valueUpdateFrekuensi}
              onChange={onChangeUpdateFrekuensi}
              className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            >
              <option value="">Pilih Frekuensi</option>
              {[...Array(2).keys()].map((i) => (
                <option key={i} value={`${i + 1}x pertahun`}>{`${
                  i + 1
                }x pertahun`}</option>
              ))}
            </select>
          </div>
          {renderTanggalInputs()}
        </div>
      </ModalBody>
      <ModalFooter>
        <Button color="danger" variant="flat" onClick={onUpdateClose}>
          Close
        </Button>
        <Button color="primary" onClick={onAdd}>
          Update
        </Button>
      </ModalFooter>
      </ModalContent>
    </Modal>
  );
}



export {
  UpdateKategoriModal,
  UpdateLokasiModal,
  UpdateBarangModal,
  UpdateBarangModalMin,
  UpdateJadwalModal,
};
