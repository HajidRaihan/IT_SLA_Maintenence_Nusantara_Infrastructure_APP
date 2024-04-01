import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input } from "@nextui-org/react";

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

export  {UpdateKategoriModal,UpdateLokasiModal};
