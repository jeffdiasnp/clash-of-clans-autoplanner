# PowerShell version of downloader.sh

param(
    [string]$fingerprint = "cb0299969c4a284ba2d84fd1eb6b2d013d5feeb9"
)

$base_url = "https://game-assets.clashofclans.com"

# Step 1: Download fingerprint.json
Invoke-WebRequest -Uri "$base_url/$fingerprint/fingerprint.json" -OutFile "fingerprint.json"

# Step 2: Extract file URLs from fingerprint.json
$json = Get-Content "fingerprint.json" | Out-String | ConvertFrom-Json

if ($null -eq $json.files) {
    Write-Host "No files found in fingerprint.json"
    exit 1
}

foreach ($fileObj in $json.files) {
    $file = $fileObj.file -replace '\\', '/'
    # Check if the file starts with csv/, logic/, or localization/
    if ($file -match '^(csv|logic|localization)/') {
        $dir = "assets/" + [System.IO.Path]::GetDirectoryName($file)
        if (!(Test-Path $dir)) {
            New-Item -ItemType Directory -Path $dir -Force | Out-Null
        }
        $outFile = "assets/$file"
        $url = "$base_url/$fingerprint/$file"
        Write-Host "Downloading $file"
        Invoke-WebRequest -Uri $url -OutFile $outFile
    }
}

Write-Host "Download complete!"
