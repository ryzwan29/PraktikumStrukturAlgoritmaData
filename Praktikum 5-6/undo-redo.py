class Stack:
    def __init__(self, limit=10):
        self.stack = []
        self.limit = limit

    def push(self, item):
        if len(self.stack) < self.limit:
            self.stack.append(item)
        else:
            print("Stack is full!")

    def pop(self):
        if self.is_empty():
            return None
        return self.stack.pop()

    def peek(self):
        if self.is_empty():
            return None
        return self.stack[-1]

    def is_empty(self):
        return len(self.stack) == 0

    def __str__(self):
        return str(self.stack)

# Main program
undo_stack = Stack()
redo_stack = Stack()
creator = "Rizwan Fairuz Mamduh"

def perform_action(action):
    print(f"Performing: {action}")
    undo_stack.push(action)

    redo_stack.stack.clear()

def undo():
    action = undo_stack.pop()
    if action:
        print(f"Undo: {action}")
        redo_stack.push(action)
    else:
        print("Nothing to undo.")

def redo():
    action = redo_stack.pop()
    if action:
        print(f"Redo: {action}")
        undo_stack.push(action)
    else:
        print("Nothing to redo.")

# Testing
perform_action("Write: Hello")
perform_action("Write: World")
perform_action("Delete: o")

undo() 
undo()  

redo()  

# Output
print("\nUndo Stack:", undo_stack)
print("Redo Stack:", redo_stack)
print("Made By:", creator)
