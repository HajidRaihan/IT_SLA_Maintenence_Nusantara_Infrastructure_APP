import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input } from "@nextui-org/react";
import {getListBarangid} from '../../api/BarangApi';
import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';


function UpdateLokasiModal({ isUpdateOpen, onUpdateClose, onAdd, value, onChange }) {

  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">Update Lokasi</ModalHeader>
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


function UpdateKategoriModal({ isUpdateOpen, onUpdateClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Update Kategori</ModalHeader>
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

function UpdateBarangModal({ isUpdateOpen, onUpdateClose, onAdd,
  valueUpdateStock,valueUpdateSpesifikasi,onUpdatespesifikasi, onUpdateStock, }) {
return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Update Barang</ModalHeader>
            <ModalBody>
                    <ModalHeader className="mb-2.5 block text-black dark:text-white">
                      Stock
                    </ModalHeader>
                    <Input
                      value={valueUpdateStock}
                      onChange={onUpdateStock}
                      placeholder="Enter New Stock"
                      type='number'
                      min='0'
                    />
                   <ModalHeader className="mb-2.5 block text-black dark:text-white">
                      Catatan
                    </ModalHeader>
                    <Input
                      value={valueUpdateSpesifikasi}
                      onChange={onUpdatespesifikasi}
                      placeholder="Enter spesifikasi"
                      type="text"
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

function UpdateBarangModalMin({ isUpdateOpen, onUpdateClose,
   onAdd, valueUpdateLokasi, onUpdateLokasi, valueUpdateStock, onUpdateStock,valueUpdateSpesifikasi,onUpdatespesifikasi }) {
  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Update Stock</ModalHeader>
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
                <ModalHeader className="mb-2.5 block text-black dark:text-white">
                      Catatan
                    </ModalHeader>
                    <Input
                      value={valueUpdateSpesifikasi}
                      onChange={onUpdatespesifikasi}
                      placeholder="Enter spesifikasi"
                      type="text"
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
function UpdateJadwalModal({ isUpdateOpen, onUpdateClose, onAdd, valueUpdateNamaKegiatan, valueUpdateTanggalMulai, valueUpdateTanggalSelesai, valueUpdatePerusahaan, valueUpdateLokasi, valueUpdateWaktuMulai, valueUpdateWaktuSelesai, onChangeUpdateNamaKegiatan, onChangeUpdateTanggalMulai, onChangeUpdateTanggalSelesai, onChangeUpdatePerusahaan, onChangeUpdateLokasi, onChangeUpdateWaktuMulai, onChangeUpdateWaktuSelesai }) {
  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center"> 
        <ModalContent>
          <ModalHeader className="flex flex-col gap-1">Add Jadwal</ModalHeader>
          <ModalBody>
          <div className="flex flex-col gap-4">
                <div className="flex flex-col gap-2">
                  <label htmlFor="nama-kegiatan" className="text-black">
                    Nama Kegiatan
                  </label>
                  <Input
              
                    autoFocus
                    value={valueUpdateNamaKegiatan}
                    onChange={onChangeUpdateNamaKegiatan}
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Enter your nama kegiatan"
                    variant="bordered"
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="tanggal-mulai" className="text-black">
                    Tanggal Mulai
                  </label>
                  <Input
                    id="tanggal-mulai"
                    autoFocus
                    value={valueUpdateTanggalMulai}
                    onChange={onChangeUpdateTanggalMulai}
                    type="date"
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Select tanggal mulai"
                    variant="bordered"
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="tanggal-mulai" className="text-black">
                    Tanggal Selesai
                  </label>
                  <Input
                    id="tanggal-mulai"
                    autoFocus
                    value={valueUpdateTanggalSelesai}
                    onChange={onChangeUpdateTanggalSelesai}
                    type="date"
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Select tanggal mulai"
                    variant="bordered"
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="perusahaan" className="text-black">
                    Perusahaan
                  </label>
                  <select
                    id="perusahaan"
                    value={valueUpdatePerusahaan}
                    onChange={onChangeUpdatePerusahaan}
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  >
                    <option value="">Pilih Perusahaan</option>
                    <option value="PT Makassar Metro Network">
                      PT Makassar Metro Network
                    </option>
                    <option value="PT Jalan Tol Seksi Empat">
                      PT Jalan Tol Seksi Empat
                    </option>
                  </select>
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="lokasi" className="text-black">
                    Lokasi
                  </label>
                  <Input
                    id="lokasi"
                    autoFocus
                    value={valueUpdateLokasi}
                    onChange={onChangeUpdateLokasi}
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Enter lokasi"
                    variant="bordered"
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="waktu-mulai" className="text-black">
                    Waktu Mulai
                  </label>
                  <Input
                    id="waktu-mulai"
                    autoFocus
                    value={valueUpdateWaktuMulai}
                    onChange={onChangeUpdateWaktuMulai}
                    type="time"
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Select waktu mulai"
                    variant="bordered"
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label htmlFor="waktu-selesai" className="text-black">
                    Waktu Selesai
                  </label>
                  <Input
                    id="waktu-selesai"
                    autoFocus
                    value={valueUpdateWaktuSelesai}
                    onChange={onChangeUpdateWaktuSelesai}
                    type="time"
                    className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                    placeholder="Select waktu selesai"
                    variant="bordered"
                  />
                </div>
              </div>
          </ModalBody>
          <ModalFooter>
            <Button color="danger" variant="flat" onPress={onUpdateClose}>
              Close
            </Button>
            <Button color="primary" onPress={onAdd}>
              Add
            </Button>
          </ModalFooter>
        </ModalContent>
      </Modal>
    </>
  );
}

function UpdateRegisbarangModal({ isUpdateOpen, onUpdateClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">Update Barang</ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Barang"
                placeholder="Update your barang"
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
export  {UpdateKategoriModal,UpdateLokasiModal,UpdateBarangModal,UpdateBarangModalMin,UpdateJadwalModal,UpdateRegisbarangModal};
