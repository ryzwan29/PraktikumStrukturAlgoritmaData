import datetime

# Node untuk barang di gudang (SLLC)
class ItemNode:
    def __init__(self, item_name, quantity):
        self.item_name = item_name
        self.quantity = quantity
        self.created_at = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        self.next = None

# SLLC untuk manajemen barang di gudang
class Inventory:
    def __init__(self):
        self.head = None
        self.tail = None

    def add_item(self, item_name, quantity):
        new_item = ItemNode(item_name, quantity)
        if not self.head:
            self.head = new_item
            self.tail = new_item
            self.tail.next = self.head
        else:
            self.tail.next = new_item
            self.tail = new_item
            self.tail.next = self.head

    def remove_item(self, item_name):
        if not self.head:
            return None
        
        current = self.head
        prev = self.tail

        while True:
            if current.item_name == item_name:
                removed_quantity = current.quantity
                created_at = current.created_at
                if current == self.head:
                    if self.head == self.tail:
                        self.head = None
                        self.tail = None
                    else:
                        self.head = self.head.next
                        self.tail.next = self.head
                else:
                    prev.next = current.next
                    if current == self.tail:
                        self.tail = prev
                return removed_quantity, created_at
            prev = current
            current = current.next
            if current == self.head:
                break
        return None

    def display_items(self):
        if not self.head:
            return "No items available.\n"
        
        items = ""
        current = self.head
        while True:
            items += f"Item: {current.item_name}, Quantity: {current.quantity}, Masuk pada: {current.created_at}\n"
            current = current.next
            if current == self.head:
                break
        return items

# Node untuk log pengeluaran (DLLC)
class LogNode:
    def __init__(self, item_name, quantity, masuk_time):
        self.item_name = item_name
        self.quantity = quantity
        self.masuk_time = masuk_time
        self.keluar_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        self.next = None
        self.prev = None

# DLLC untuk mencatat log pengeluaran
class LogList:
    def __init__(self):
        self.head = None
        self.tail = None

    def add_log(self, item_name, quantity, masuk_time):
        new_log = LogNode(item_name, quantity, masuk_time)
        if not self.head:
            self.head = new_log
            self.tail = new_log
            self.head.next = self.head
            self.head.prev = self.tail
        else:
            self.tail.next = new_log
            new_log.prev = self.tail
            self.tail = new_log
            self.tail.next = self.head
            self.head.prev = self.tail

    def display_logs(self):
        if not self.head:
            return "No logs available.\n"

        logs = ""
        current = self.head
        while True:
            logs += (f"Item: {current.item_name}, Quantity: {current.quantity}, "
                     f"Masuk: {current.masuk_time}, Keluar: {current.keluar_time}\n")
            current = current.next
            if current == self.head:
                break
        return logs

# ==== Main Program ====
def main():
    inventory = Inventory()
    log_list = LogList()

    while True:
        print("\n===== Warehouse Inventory Management =====")
        print("1. Tambah Barang")
        print("2. Keluarkan Barang")
        print("3. Tampilkan Semua Barang")
        print("4. Tampilkan Log Pengeluaran")
        print("5. Keluar")
        choice = input("Pilih menu (1-5): ")

        if choice == "1":
            item_name = input("Nama Barang: ")
            quantity = int(input("Jumlah Barang: "))
            inventory.add_item(item_name, quantity)
            print(f"Barang '{item_name}' sebanyak {quantity} berhasil ditambahkan.")

        elif choice == "2":
            item_name = input("Nama Barang yang Mau Dikeluarkan: ")
            result = inventory.remove_item(item_name)
            if result is not None:
                removed_qty, masuk_time = result
                log_list.add_log(item_name, removed_qty, masuk_time)
                print(f"Barang '{item_name}' sebanyak {removed_qty} berhasil dikeluarkan.")
            else:
                print(f"Barang '{item_name}' tidak ditemukan!")

        elif choice == "3":
            print("\n--- Daftar Barang di Gudang ---")
            print(inventory.display_items())

        elif choice == "4":
            print("\n--- Log Pengeluaran Barang ---")
            print(log_list.display_logs())

        elif choice == "5":
            print("Terimakasih🙏 || Made By 241232020 - Rizwan Fairuz Mamduh")
            break

        else:
            print("Pilihan tidak valid, coba lagi!")

if __name__ == "__main__":
    main()
