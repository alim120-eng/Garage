import * as ftp from 'basic-ftp';

const config = {
    host: "ftpupload.net",
    user: "if0_42078692",
    password: "SjNpKLwmeMQFL",
    remoteDir: "/htdocs"
};

async function uploadViews() {
    const client = new ftp.Client();
    try {
        await client.access(config);
        console.log("Connected to FTP");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/welcome.blade.php", "/htdocs/resources/views/welcome.blade.php");
        console.log("Uploaded welcome.blade.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/layouts/navigation.blade.php", "/htdocs/resources/views/layouts/navigation.blade.php");
        console.log("Uploaded navigation.blade.php");

    } catch (err) {
        console.error(err);
    } finally {
        client.close();
    }
}

uploadViews();
