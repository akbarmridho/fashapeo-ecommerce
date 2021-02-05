class AuthCheck {
    adminCheck() {
        let authenticated;
        window.axios.get("/auth/admin").then((response) => {
            authenticated = Boolean(response);
        });
        return authenticated;
    }

    customerCheck() {
        let authenticated;
        window.axios.get("/auth/customer").then((response) => {
            authenticated = Boolean(response);
        });
        return authenticated;
    }
}

export default AuthCheck;
