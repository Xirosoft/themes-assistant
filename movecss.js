const fs = require('fs');
const path = require('path');

// Function to delete all files in a directory
const deleteFilesInDirectory = (dir) => {
    fs.readdir(dir, (err, files) => {
        if (err) {
            console.error(`Error reading directory: ${err}`);
            return;
        }
        
        // Loop through the files and delete each one
        files.forEach(file => {
            const filePath = path.join(dir, file);
            fs.unlink(filePath, (err) => {
                if (err) {
                    console.error(`Error deleting file ${filePath}: ${err}`);
                } else {
                    console.log(`Deleted file: ${filePath}`);
                }
            });
        });
    });
};

// Function to copy files from one directory to another
const copyFiles = (sourceDir, targetDir) => {
    fs.readdir(sourceDir, (err, files) => {
        if (err) {
            console.error(`Error reading source directory: ${err}`);
            return;
        }

        // Loop through the files and copy each one
        files.forEach(file => {
            const sourceFilePath = path.join(sourceDir, file);
            const targetFilePath = path.join(targetDir, file);
            fs.copyFile(sourceFilePath, targetFilePath, (err) => {
                if (err) {
                    console.error(`Error copying file ${file}: ${err}`);
                } else {
                    console.log(`Copied file: ${file} to ${targetDir}`);
                }
            });
        });
    });
};

// Main function to execute the delete and copy
const main = (sourceDir, targetDir) => {
    // Delete files in the target directory
    deleteFilesInDirectory(targetDir);

    // Copy files from the source directory to the target directory
    copyFiles(sourceDir, targetDir);
};

// Replace 'sourceDirectoryPath' and 'targetDirectoryPath' with your actual paths
const sourceDirectoryPath = 'assets/frontend/scss/css';
const targetDirectoryPath = 'assets/frontend/css/widget';

main(sourceDirectoryPath, targetDirectoryPath);
