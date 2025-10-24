function calculateDaysAgo(a, l) {
    let e = moment(a),
        f = moment(),
        n = f.diff(e, "days"),
        t = "";
    if (0 === n) {
        let i = f.diff(e, "hours");
        if (0 === i) {
            let u = f.diff(e, "minutes");
            t = `${u} menit yang lalu`;
        } else t = `${i} jam yang lalu`;
    } else
        t =
            n > 365
                ? `${e.format("DD MMMM YYYY")} ${Math.floor(n / 365)} tahun ${
                      n % 365
                  } hari yang lalu`
                : `${e.format("DD MMMM YYYY")} (${n} hari yang lalu)`;
    document.getElementById(l).innerHTML = t;
}
