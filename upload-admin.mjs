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

        await client.ensureDir("/htdocs/resources/views/admin/contacts");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/admin/contacts/index.blade.php", "/htdocs/resources/views/admin/contacts/index.blade.php");
        console.log("Uploaded contacts index view");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/admin/dashboard.blade.php", "/htdocs/resources/views/admin/dashboard.blade.php");
        console.log("Uploaded admin dashboard");

    } catch (err) {
        console.error(err);
    } finally {
        client.close();
    }
}

uploadViews();
