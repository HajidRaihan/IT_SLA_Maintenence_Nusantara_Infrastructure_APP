import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input } from "@nextui-org/react";

function LokasiModal({ isOpen, onClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">Add Lokasi</ModalHeader>
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
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function KategoriModal({ isOpen, onClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Add Kategori</ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Kategori"
                placeholder="Enter your kategori"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

export {LokasiModal,KategoriModal};
