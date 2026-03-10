import os

filepath = r'c:\Users\rahma\Desktop\Bumdesgo\resources\views\welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = ["@extends('layouts.app')\n\n@section('content')\n"]
# Lines 12-17 (inclusive) in editor = index 11-16
new_lines.extend(lines[11:17])
# Lines 51-342 (inclusive) in editor = index 50-341
new_lines.extend(lines[50:342])
new_lines.append("@endsection\n")

with open(filepath, 'w', encoding='utf-8') as f:
    f.writelines(new_lines)

print("Refactoring complete.")
