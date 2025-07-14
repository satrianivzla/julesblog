// This script is for manually running in a Node.js environment
// or a browser console capable of handling large string inputs and file system (for Node)
// to extract data from the SQL file and convert it into JavaScript arrays.

const fs = require('fs'); // Only for Node.js execution

// In a browser environment, you would fetch the SQL content, e.g., using fetch()
// For this example, let's assume the SQL content is loaded into a variable `sqlContent`
// const sqlContent = `... SQL content here ...`; // Placeholder

// Function to parse INSERT INTO statements for a given table
function parseInserts(sqlContent, tableName) {
    const data = [];
    const regex = new RegExp(`INSERT INTO \`${tableName}\` \\((.*?)\\) VALUES\\n(.*?);`, 'gs');
    let match;

    while ((match = regex.exec(sqlContent)) !== null) {
        const lines = match[2].split('\\n');
        lines.forEach(line => {
            if (line.trim() === '') return;
            const valuesString = line.trim().replace(/^\\(|\\);?$/g, '').replace(/\\),\\($/g, ''); // Clean up line endings

            // Handle various data types: numbers, strings, and properly escaped strings
            const values = [];
            let currentVal = '';
            let inString = false;
            let escapeNext = false;

            for (let i = 0; i < valuesString.length; i++) {
                const char = valuesString[i];

                if (escapeNext) {
                    currentVal += char;
                    escapeNext = false;
                    continue;
                }

                if (char === '\\\\') {
                    escapeNext = true;
                    currentVal += char; // Keep the backslash as it's part of the escaped char
                    continue;
                }

                if (char === "'") {
                    inString = !inString;
                    currentVal += char;
                } else if (char === ',' && !inString) {
                    values.push(currentVal.trim());
                    currentVal = '';
                } else {
                    currentVal += char;
                }
            }
            values.push(currentVal.trim()); // Add the last value

            const cleanedValues = values.map(val => {
                if (val.startsWith("'") && val.endsWith("'")) {
                    return val.substring(1, val.length - 1).replace(/\\\\'/g, "'"); // Unescape apostrophes
                }
                if (val === 'NULL') return null;
                if (!isNaN(val)) return Number(val);
                return val; // Should be a string already if not number or NULL
            });

            // Assuming column names are consistent for simplicity here
            // A more robust parser would use the column list from `match[1]`
            if (tableName === 'estados') {
                data.push({ id_estado: cleanedValues[0], estado: cleanedValues[1], iso_3166_2: cleanedValues[2] });
            } else if (tableName === 'ciudades') {
                data.push({ id_ciudad: cleanedValues[0], id_estado: cleanedValues[1], ciudad: cleanedValues[2], capital: cleanedValues[3] });
            } else if (tableName === 'municipios') {
                data.push({ id_municipio: cleanedValues[0], id_estado: cleanedValues[1], municipio: cleanedValues[2] });
            } else if (tableName === 'parroquias') {
                data.push({ id_parroquia: cleanedValues[0], id_municipio: cleanedValues[1], parroquia: cleanedValues[2] });
            }
        });
    }
    return data;
}

// Main function to run the parser (Node.js example)
async function main() {
    try {
        // In a browser, you'd fetch this. For Node, read from file or use the GitHub URL.
        // For simplicity, I'll simulate fetching it.
        const response = await fetch("https://raw.githubusercontent.com/marydn/venezuela-sql/master/venezuela.sql");
        if (!response.ok) {
            console.error("Failed to fetch SQL file:", response.statusText);
            return;
        }
        const sqlContent = await response.text();

        const estados = parseInserts(sqlContent, 'estados');
        const ciudades = parseInserts(sqlContent, 'ciudades');
        const municipios = parseInserts(sqlContent, 'municipios');
        const parroquias = parseInserts(sqlContent, 'parroquias');

        const output = `
const venezuelaData = {
    estados: ${JSON.stringify(estados, null, 4)},
    ciudades: ${JSON.stringify(ciudades, null, 4)},
    municipios: ${JSON.stringify(municipios, null, 4)},
    parroquias: ${JSON.stringify(parroquias, null, 4)}
};

// Export for Node.js if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = venezuelaData;
}
        `;

        // For Node.js: Save to a file
        fs.writeFileSync('venezuela-data.js', output, 'utf8');
        console.log('Data parsed and saved to venezuela-data.js');

        // For browser: You might log it or assign to a window variable
        // console.log(output);
        // window.venezuelaData = { estados, ciudades, municipios, parroquias };

    } catch (error) {
        console.error("Error parsing SQL data:", error);
    }
}

// If running in Node.js, uncomment the next line:
// main();
// Otherwise, you'd adapt this to run in a browser's developer console
// by pasting the functions and then calling main() or a similar entry point
// after loading sqlContent.

// Helper for browser:
// async function runInBrowser() {
//   const response = await fetch("https://raw.githubusercontent.com/marydn/venezuela-sql/master/venezuela.sql");
//   const sqlContent = await response.text();
//   const estados = parseInserts(sqlContent, 'estados');
//   const ciudades = parseInserts(sqlContent, 'ciudades');
//   const municipios = parseInserts(sqlContent, 'municipios');
//   const parroquias = parseInserts(sqlContent, 'parroquias');
//   window.venezuelaData = { estados, ciudades, municipios, parroquias };
//   console.log("venezuelaData object is now available in the window scope.", window.venezuelaData);
// }
// console.log("To parse in browser, call runInBrowser()");

// Note: Due to the large size of the SQL and potential browser limitations
// for handling such large strings directly in a script tag or dev console,
// running this parser in Node.js (to generate a .js file) is more robust.
// The generated 'venezuela-data.js' can then be easily included in an HTML page.

// Simplified version for direct inclusion in HTML, assuming SQL content is small enough
// or fetched and assigned to `sqlContentFromSomewhere`
function parseSqlData(sqlContentFromSomewhere) {
    const estados = parseInserts(sqlContentFromSomewhere, 'estados');
    const ciudades = parseInserts(sqlContentFromSomewhere, 'ciudades');
    const municipios = parseInserts(sqlContentFromSomewhere, 'municipios');
    const parroquias = parseInserts(sqlContentFromSomewhere, 'parroquias');
    return { estados, ciudades, municipios, parroquias };
}

// Example of how it might be used if SQL content was available:
// const sqlContentFromSomewhere = "... your SQL content ...";
// const venezuelaData = parseSqlData(sqlContentFromSomewhere);
// console.log(venezuelaData);
