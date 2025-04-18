import os

def convert_html_to_php():
    # Get the current directory
    current_dir = os.getcwd()
    
    # List all files in the current directory
    files = os.listdir(current_dir)
    
    # Counter for renamed files
    renamed_count = 0
    
    # Iterate through each file
    for filename in files:
        # Check if the file has an .php extension
        if filename.lower().endswith('.php'):
            # Create the new filename with .php extension
            new_filename = filename[:-5] + '.php'
            
            # Full paths for old and new files
            old_file_path = os.path.join(current_dir, filename)
            new_file_path = os.path.join(current_dir, new_filename)
            
            try:
                # Rename the file
                os.rename(old_file_path, new_file_path)
                print(f"Renamed: {filename} -> {new_filename}")
                renamed_count += 1
            except Exception as e:
                print(f"Error renaming {filename}: {str(e)}")
    
    # Print summary
    if renamed_count > 0:
        print(f"\nSuccess! Renamed {renamed_count} HTML files to PHP.")
    else:
        print("\nNo HTML files found in the current directory.")

if __name__ == "__main__":
    # Execute the conversion function
    convert_html_to_php()